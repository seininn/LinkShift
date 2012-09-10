function ui_string_update(){
    if (localStorage["lang"] == AR) {
        document.body.style.direction="rtl";
        document.body.setAttribute("dir", "rtl");
        document.body.setAttribute("lang", "ar");
    }
    else {
        localStorage["lang"] = EN;
        document.body.style.direction="ltr";
        document.body.setAttribute("dir", "ltr");
        document.body.setAttribute("lang", "en");
    }
    for (var i in ui_textContent) {
        if (!document.getElementById(i)) continue;
        document.getElementById(i).textContent=ui_textContent[i][localStorage["lang"]];
    }
    if (document.getElementById("url")) document.getElementById("url").setAttribute("placeholder", ui_misc["url"][localStorage["lang"]]);
    if (document.getElementById("button")) document.getElementById("button").value = ui_misc["button"][localStorage["lang"]];
    
}

var ui_textContent = [], ui_misc = [], AR = 1, EN =0;
ui_textContent["header"]     = ["LinkShift", "لِنكشِفت"];
ui_textContent["bookmarklet"]     = ["LinkShift", "لنكشفت"];
ui_textContent["language-text"]     = ["Interface language:", "لغة واجهة الموقع:"];
ui_textContent["guthub-text"]       = ["LinkShift open source project available at", "هذا المشروع حر المصدر، ويمكنك تنزيله والمساهمة في تطويره لدى"];
ui_textContent["bookmarklet-text"]  = ["Drag this bookmarklet to your bookmarks to shorten links on the go", "ضع المرجعية التالية في قائمة المرجعيات بمتصفحك لاختصار الروابط بضغطة زر"];
ui_textContent["result-header"]     = ["Use Ctrl+C to copy the url.", "اضغط على المفتاحين Ctrl+C لنقل العنوان المختصر."];
ui_textContent["another"]           = ["Shorten another link?", "إختصر عنوان آخر"];
ui_misc["url"]     =   ["URL", "عنوان الصفحة"];
ui_misc["button"]  =   ["Shorten", "اختصر"];
