<?php
/******************************************************************************
PAVONESSA SET UP FILE.  ONLY RERUN TO START OVER.  DO NOT RUN UNLESS YOU WANT
TO RESET CMS.  UNCOMMENT THE REST OF THE FILE BELOW BEFORE YOU RUN IT.
******************************************************************************/

/*****************************************************************************
v0.0.1, November 4th, 2015
*****************************************************************************/

if($_POST){

  if($_POST['host'] && $_POST['username'] && $_POST['password'] && $_POST['db_name']
  && $_POST['u'] && $_POST['p'] && $_POST['p2'] == $_POST['p']
  && $_POST['fname'] && $_POST['lname'] && $_POST['email']){ // checks for all vars
  //checks if user passwords match

    try {
        $db = new PDO('mysql:host=' . $_POST['host'] . ';dbname=' . $_POST['db_name'],
        $_POST['username'], $_POST['password']);
    } catch (PDOException $e){
        print "Error!: " . $e->getMessage() . "<br/>";
        include_once("config.php?failed=true"); //if db vars not there.
    }

    $conn_data = array($_POST['host'],$_POST['username'],$_POST['password'],$_POST['db_name']);
    // for storing later

    /* This assumes the connection worked */
    $stmnt = $db->prepare("
        DROP TABLE users;
        DROP TABLE articles;
        DROP TABLE superindex;

        CREATE TABLE users (
          `_id` VARCHAR(60),
          `fname` VARCHAR(100),
          `lname` VARCHAR(100),
          `email` VARCHAR(100),
          `type` VARCHAR(100),
          `sessionid1` VARCHAR(100),
          `sessionid2` VARCHAR(100),
          `lastloggedin` VARCHAR(100)
        );

        CREATE TABLE articles (
          `_a` VARCHAR(60),
          `title` VARCHAR(60),
          `authors` VARCHAR(60),
          `subtitle` VARCHAR(60),
          `blurb` VARCHAR(60),
          `text` LONGBLOB,
          `parent` VARCHAR(60),
          `category` VARCHAR(60)
        );

        CREATE TABLE superindex (
          `_s` VARCHAR(60),
          `_url` VARCHAR(260)
        );

    ");

    $stmnt->execute();
    // Created Users Database.

    $id = md5(mt_rand() . time()); // create user id
    $sessionid1 = md5(mt_rand() . mt_rand()); // create user id
    $sessionid2 = md5(mt_rand() . mt_rand()); // create user id
    $lastloggedin = time();

    $stmnt = $db->prepare("INSERT INTO users (`_id`,`fname`,`lname`,`email`,`type`,`sessionid1`,`sessionid2`,`lastloggedin`)
    VALUES (:id, :fname,:lname,:email,'super',:sessionid1,:sessionid2,:lastloggedin)");

    $stmnt->execute([
      ':id'     => $id,
      ':fname'  => $_POST['fname'],
      ':lname'  => $_POST['lname'],
      ':email'  => $_POST['email'],
      ':sessionid1' => $sessionid1,
      ':sessionid2' => $sessionid2,
      ':lastloggedin' => $lastloggedin
    ]);

    // Binds Params since Fname and Lname are passed in by the user.
    setcookie('email', $row['email'], time() + 60 * 60 * 24, "/");
    setcookie('a', $row['sessionid1'], time() + 60 * 60 * 24, "/");
    setcookie('s', $row['sessionid2'], time() + 60 * 60 * 24, "/");

    /* CREATE SUPER INDEX */

    $stmnt = $db->prepare("INSERT INTO superindex (`_a`) VALUES ('main')"); // [todo] add url later.
    $stmnt->execute();



    /* CREATE CONFIG.PHP */
    $filename = "core/config.php";
    $myfile = fopen($filename, "w") or die("Shoot!");
    $txt = "
    <?php
    return [
        'db' => [
              'uri' => '" . 'mysql:host=' . $_POST['host'] . ';dbname=' . $_POST['db_name'] . "',
              'user' => '" . $_POST['username']. "',
              'pw' => '" . $_POST['password'] . "'
        ]
    ];?>
    "; // writing hardcoded config file.

    echo $filename;
    echo $txt;
    fwrite($myfile, $txt);
    fclose($myfile); // close file.


  } else {
  include_once("config.php?error=true"); //if db vars not there.
  }

} else {
  include_once("config.php"); // otherwise.
}
