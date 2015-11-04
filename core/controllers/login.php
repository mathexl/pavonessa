<?php
$config = require_once(__DIR__.'/../config.php');
$db = require_once(__DIR__.'/../db.php');
$errcodes = require_once(__DIR__.'/../errcodes.php');

$stmnt = $db->prepare("call doLogin(:email,:pw)");
$stmnt->execute([':email'=>$_POST['email'], ':pw'=>$_POST['pw']]);
$row = $stmnt->fetch();
setcookie('email', $row['email'], time() + 60 * 60 * 24, "/");
setcookie('a', $row['sessionid1'], time() + 60 * 60 * 24, "/");
setcookie('s', $row['sessionid2'], time() + 60 * 60 * 24, "/");

print json_encode($row);
