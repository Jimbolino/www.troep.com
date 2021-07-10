<html lang="en">
<head>
    <title>Send me an email</title>
</head>
<body>
<form method="post" action="/mailmij.php">
    @csrf
    <table>
        <tr>
            <td>From: </td>
            <td><input name="from" type="text"></td>
        </tr>
        <tr>
            <td>Message: </td>
            <td><textarea name="message" cols="40" rows="10"></textarea></td>
        </tr>
        <tr>
            <td>
                <script>
                    document.write("<input type=\"hidden\" NAME=\"screenresolution\" value=\"" + screen.width+"*"+screen.height + "\" />");
                    document.write("<input type=\"hidden\" NAME=\"usedresolution\" value=\"" + window.screen.availWidth+"*"+window.screen.availHeight + "\" />");
                    document.write("<input type=\"hidden\" NAME=\"colordepth\" value=\"" + window.screen.colorDepth + "\" />");
                    document.write("<input type=\"hidden\" NAME=\"browser\" value=\"" + navigator.appName + "\" />");
                    document.write("<input type=\"hidden\" NAME=\"version\" value=\"" + navigator.appVersion + "\" />");
                    if (navigator.userAgent.indexOf("MSIE") > 0) {document.write("<input type=\"hidden\" NAME=\"windowsize\" value=\"" + document.body.clientWidth+"*"+document.body.clientHeight + "\" />");}
                    else {document.write("<input type=\"hidden\" NAME=\"windowsize\" value=\"" + window.outerWidth+"*"+window.outerHeight + "\" />");}
                </script>
            </td>
        </tr>
        <tr>
            <td colspan="2"><input name="submit" type="submit" value="Verzenden" /></td>
        </tr>
    </table>
</form>
</body>
</html>
