<!DOCTYPE html>
<html>
<body>

<h2>Navicat password decrypter</h2>
<p>Tested with version 15</p>

<form action="/navicat">
    <label for="version">Version:</label><br>
    <input type="number" min="11" max="15" id="version" name="version" value="{{request('version', $defaultVersion)}}"><br>
    <label for="password">Password hash:</label><br>
    <input type="text" id="password" name="password" value="{{request('password', $defaultHash)}}"><br><br>
    <input type="submit" value="Submit">
</form>

<p>{{ $result }}</p>

</body>
</html>
