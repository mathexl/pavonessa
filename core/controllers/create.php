<?php
$config = require_once(__DIR__.'/../config.php');
$db = require_once(__DIR__.'/../db.php');
$errcodes = require_once(__DIR__.'/../errcodes.php');

$stmnt = $db->prepare("
  SELECT accountsetup FROM users WHERE users._id=:id
");

$stmnt->execute([
    ':id'        =>$_POST['id'],
]);

$row = $stmnt->fetch();
if($row['accountsetup'] < 1){

    $stmnt = $db->prepare("
        UPDATE users SET accountsetup=0, sessionid1=md5(now()*rand()), sessionid2=md5(now()*rand())
          WHERE users._id=:id;
    ");

    $stmnt->execute([
        ':id'        =>$_POST['id'],
    ]);

    $stmnt = $db->prepare("
        SELECT email, sessionid1, sessionid2 FROM users
          WHERE users._id=:id;
    ");

    $stmnt->execute([
        ':id'        =>$_POST['id'],
    ]);
    
    $row = $stmnt->fetch();
    setcookie('email', $row['email'], time() + 60 * 60 * 24, "/");
    setcookie('a', $row['sessionid1'], time() + 60 * 60 * 24, "/");
    setcookie('s', $row['sessionid2'], time() + 60 * 60 * 24, "/");
}
