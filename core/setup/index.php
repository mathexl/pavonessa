<?php
/******************************************************************************
PAVONESSA SET UP FILE.  ONLY RERUN TO START OVER.  DO NOT RUN UNLESS YOU WANT
TO RESET CMS.  UNCOMMENT THE REST OF THE FILE BELOW BEFORE YOU RUN IT.
******************************************************************************/

/*****************************************************************************
v0.0.1, November 4th, 2015
*****************************************************************************/

if($_POST){

  if($_POST['host'] && $_POST['username'] && $_POST['password'] && $_POST['db_name']){

    try {
        $db = new PDO('mysql:host=' . $_POST['host'] . ';dbname=' . $_POST['db_name'],
        $_POST['username'], $_POST['password']);

    } catch (PDOException $e){
        include_once("config.php?failed=true"); //if db vars not there.
    }

    /* This assumes the connection worked */
    /*
    $stmnt = $db->prepare("

        CREATE TABLE users (
          `_id` VARCHAR(60),
          `fname` VARCHAR(100),
          `lname` VARCHAR(100),
          `type` VARCHAR(100),
          `sessionid1` VARCHAR(100),
          `sessionid2` VARCHAR(100),
          `lastloggedin` VARCHAR(100)
        );

    ");

    $stmnt->execute();
    */

  } else {
  include_once("config.php?error=true"); //if db vars not there.
  }

} else {
  include_once("config.php"); // otherwise.
}
