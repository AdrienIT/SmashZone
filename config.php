<?php
$db = new PDO('mysql:host=localhost; dbname=smashzone;charset=utf8', 'root', 'root');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!$db) {
	die("Bad Connection");
}
