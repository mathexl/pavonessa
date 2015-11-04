<?php
header('Access-Control-Allow-Origin: *');
$config = require_once(__DIR__.'/../config.php');
$db = require_once(__DIR__.'/../db.php');
$errcodes = require_once(__DIR__.'/../errcodes.php');

$stmnt = $db->prepare("call getUser(:sessionid1,:sessionid2, :email)");
$stmnt->execute(array(':sessionid1' => $_COOKIE['a'], ':sessionid2' => $_COOKIE['s'], ':email'=>$_COOKIE['email']));

print json_encode($stmnt->fetch());
