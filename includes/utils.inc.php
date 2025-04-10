<?php
// Deletes a cookie of $name
function deleteCookie($name, $path = "", $domain = "")
{
	setcookie($name, "", time() - 3600, $path, $domain);
}
?>