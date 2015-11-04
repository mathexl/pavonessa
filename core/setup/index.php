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
        return new PDO('mysql:host=' . $_POST['host'] . ';dbname=' . $_POST['db_name'],
        $_POST['username'], $_POST['password']);
    } catch (PDOException $e){
         echo 'Connection failed: ' . $e->getMessage();
    }


  } else {
  include_once("config.php?error=true"); //if db vars not there.
   }
} else {
  include_once("config.php"); // otherwise.
}
