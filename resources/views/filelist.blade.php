<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<html>
<head>
    <title>Index of /{{$dir}}</title>
</head>
<body>
<h1>Index of /{{$dir}}</h1>
<h2>Move along, there's nothing to see here...</h2> <table>
    <tr><th valign="top"><img src="/images/icons/blank.gif" alt="[ICO]"></th><th><a href="?C=N;O=D">Name</a></th><th><a href="?C=M;O=A">Last modified</a></th><th><a href="?C=S;O=A">Size</a></th><th><a href="?C=D;O=A">Description</a></th></tr>
    <tr><th colspan="5"><hr></th></tr>
    <tr><td valign="top"><img src="/images/icons/back.gif" alt="[PARENTDIR]"></td><td><a href="/{{$dir}}/../">Parent Directory</a></td><td>&nbsp;</td><td align="right"> - </td><td>&nbsp;</td></tr>

    @foreach ($files as $file)
        <tr>
            <td valign="top">
                <img src="/images/icons/{{$file['icon']}}.gif" alt="[IMG]">
            </td>
            <td>
                <a href="/{{ @$file['path']}}">{{ @$file['basename'] }}</a>
            </td>
            <td align="right">{{ date('Y-m-d H:i', @$file['timestamp']) }} </td>
            <td align="right"> {{ @$file['size']}}</td>
            <td>&nbsp;</td>
        </tr>
    @endforeach

    <tr><th colspan="5"><hr></th></tr>
</table>
<h6>Did you find what you were looking for? <a href="https://www.google.com">No</a> / <a href="hidden">Yes</a></h6></body></html>
