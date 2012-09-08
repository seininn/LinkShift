<!DOCTYPE html>
<?php

//script to get the next token and save the (next token, long url)
//then return the short url to the user
//Saleh Alsanad, @bo9lo7
//saleh [AT] angelic [DOT] com

//given: url => long url

require 'functions.php';

//check if long url is not set then exit
if (!isset($_POST['url'])) die("url is not set");

//init sql connection
$conn = init_sql_conn();

//check if sql connection is not made
if (!$conn) die("cannot connect to sql server");

//escape long url string to prevent sqli
$longurl = mysql_real_escape_string($_POST['url']);

//add http:// before url if it does not exists, bug discovered by @fR00s
if (!preg_match('/^https?\:\/\//', $longurl)) $longurl = "http://".$longurl; 

//check url validity
//bug discovered by @almhayat let me change the check method to regex
if (!preg_match('/^https?\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]+(\/.*)*$/', $longurl)) die('invalid url');

//check for url's existence
$t = get_url_token($longurl);

//check if the token exists
if ($t != FALSE) {
	//token exists, no need to save two tokens for one url
	echo form_short_url($t);
	exit;
}

//get the next token and increment the old one
$token = get_next_token_and_inc();

//check if the token is not valid (FALSE)
if (!$token) die("cannot generate short url");

//add the new (token, long url) into database
if (!add_long_url($token, $longurl)) die("cannot add long url");

//display short url to user
$out = form_short_url($token);
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>linkshift</title>
        <link type="text/css" rel="stylesheet" href="style.css">
        <script type="text/javascript" src="ui.js" ></script>
    </head>
    <body onload='ui_string_update();document.getElementById("result").focus();document.getElementById("result").select();'> 
        <div><span id="result-header">Use Ctrl+C to copy the url.</span> <a id="another" href="index.html">Shorten another link?</a></div>
        <input id="result" type="text" value="<?php echo $out ?>" readonly="readonly" onclick="this.select()" onfocus="this.select()">
        <div id="footer">
            <span id="language-text">Interface language:</span> 
            <a onclick="localStorage['lang'] = AR; ui_string_update();" href="#">اللغة عربية</a> -
            <a onclick="localStorage['lang'] = EN; ui_string_update();" href="#">English</a> <br>
	        <span id="guthub-text">LinkShift open source project available at</span> <a href="https://github.com/BoSanad/LinkShift">Github</a>
        </div>
    </body>
</html>
