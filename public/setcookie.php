<?php
// $cookieName = 'TestCookie';
// $cookieValue = 'TestValue';

// // Set the cookie and redirect
// setcookie($cookieName, $cookieValue, [
// 	'expires' => time() + 3600, // 1 hour from now
// 	'path' => '/',
// 	'domain' => '', // Leave empty for current domain
// 	'secure' => false, // Set to true if testing over HTTPS
// 	'httponly' => false, // Allow access via JavaScript if needed
// 	'samesite' => 'Lax', // Default SameSite behavior
// ]);

// header('Location: wascookieset.php');
// exit;

$cookieName = 'TestCookie';
$cookieValue = 'TestValue';

// Set the cookie and redirect
setcookie(
	$cookieName,
	$cookieValue,
	0, // Expires
	'/', // Path
	'localhost:8008', // Domain (empty for current domain)
	false, // Secure
	true  // HttpOnly
);

header('Location: wascookieset.php');
exit;

