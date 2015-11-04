<?php
error_reporting(error_reporting() & ~E_NOTICE & ~E_WARNING);

try {
    return new PDO($config['db']['uri'], $config['db']['user'], $config['db']['pw']);
} catch (PDOException $e){
  //  echo 'Connection failed: ' . $e->getMessage();
}
