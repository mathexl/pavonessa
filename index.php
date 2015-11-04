<?php
error_reporting(error_reporting() & ~E_NOTICE & ~E_WARNING);
if(!file_exists('core/config.php')){
  require_once(__DIR__.'/core/setup/index.php');
} else {
  require_once(__DIR__.'/public/init.php');
}
