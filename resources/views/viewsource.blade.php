<html>
<head>
    <title>View source (c) Jimbolino - troep.com</title>
    <script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js"></script>
</head>
<body>

<form method="POST" action="">
    @csrf
    <input type="text" name="url" size="100" value="{{ $url }}">
    <input type="submit" value="view source" name="knop">
</form>

<h1>Headers</h1>
<pre>{{ print_r($http_response_header,true) }}</pre>

<h1>Content</h1>
<pre class="prettyprint">{{ $contents }}</pre>

</body>
</html>
