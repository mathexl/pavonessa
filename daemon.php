<?php
$filename = "index.php";
$myfile = fopen($filename, "w") or die("Shoot!");
$txt = "
<?php
    error_reporting(error_reporting() & ~E_NOTICE & ~E_WARNING);
//  require_once(__DIR__.'/core/setup/index.php');

require_once(__DIR__.'/public/init.php');
"; // writing hardcoded config file.
fwrite($myfile, $txt);
fclose($myfile);

header("Location: index.php");
?>
