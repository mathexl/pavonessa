<?php
$config = require_once(__DIR__.'/../config.php');
$db = require_once(__DIR__.'/../db.php');
$errcodes = require_once(__DIR__.'/../errcodes.php');

$stmnt = $db->prepare("call updateUserSettings(:email,:pw,:pw_set)");
$stmnt->execute([':email'=>$_POST['email'], ':pw'=>$_POST['pw'], ':pw_set'=>$_POST['pw_set']]);
$row = $stmnt->fetch();


echo json_encode($row);
