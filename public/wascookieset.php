<?php
$cookieName = 'TestCookie';
$cookieWasSet = isset($_COOKIE[$cookieName]) ? 'true' : 'false';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cookie Test</title>
</head>
<body>
	<h1>Was the cookie set?</h1>
	<p>Cookie "<?= htmlspecialchars($cookieName) ?>" was set: <strong><?= $cookieWasSet ?></strong></p>
	<p><a href="setcookie.php">Set the cookie again</a></p>
	<pre>
Cookies:
<?php var_dump($_COOKIE); ?>

Server:
<?php var_dump($_SERVER); ?>

Request:
<?php var_dump($_REQUEST); ?>
	</pre>
</body>
</html>
