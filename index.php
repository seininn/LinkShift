<!DOCTYPE html>
<?php
	//script to get long url and shorten it
	//then save it in database and show it to user
	//Saleh Alsanad, @bo9lo7
	//saleh [AT] angelic [DOT] com
    
require 'config.inc';

?>

<html>
    <head>
        <meta charset="utf-8">
        <title>linkshift</title>
        <link type="text/css" rel="stylesheet" href="style.css">
        <script type="text/javascript" src="ui.js" ></script>
    </head>
    <body onload="ui_string_update()">
        <div> 
            <span id="bookmarklet-text">Drag this bookmarklet to your bookmarks to shorten links on the go </span>
            <a id="bookmarklet" href="javascript:(function(){var f = document.createElement('form'), v = document.createElement('input');f.setAttribute('method', 'post');f.setAttribute('action', '<?php echo BASE_URL ?>/short.php');v.setAttribute('name', 'url');v.setAttribute('value', window.location.href);f.appendChild(v);f.submit();})()">LinkShift</a>
        </div>
        
        <h1 id="header">LinkShift</h1>
        
        <div id="bar">
            <form method="post" action="short.php">
	            <input id="url" type="text" name="url" placeholder="URL" tabindex="1" autofocus="autofocus" onkeydown="this.style.direction='ltr'">
	            <input id="button" type="submit" value="Shorten" tabindex="2">
            </form>
        </div>
        <div id="footer">
            <span id="language-text">Interface language:</span> 
            <a onclick="localStorage['lang'] = AR; ui_string_update();" href="#">اللغة عربية</a> -
            <a onclick="localStorage['lang'] = EN; ui_string_update();" href="#">English</a> <br>
	        <span id="guthub-text">LinkShift open source project available at</span> <a href="https://github.com/BoSanad/LinkShift">Github</a>
        </div>
    </body>
</html>


