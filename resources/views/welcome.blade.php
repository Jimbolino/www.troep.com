<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Troep.com, the worst troep on the planet"/>
    <meta name="keywords" content="troep, jimbolino, tilburg, rommel, puinhoop"/>

    <title>Troep.com - index</title>
</head>
<body>
<div>
    {!! $randomQuote !!} <br/>
    <br/>
    <br/><b>troep.com</b>
    <br/><a href="mailmij.php">submit quote</a>
    <br/><a href="startpage.php">startpage</a>
    <br/><a href="https://jim.troep.com">jim.troep.com</a></div>
</body>
</html>
