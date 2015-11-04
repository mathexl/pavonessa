<?php
    $pageid=$_GET['pageid'];
    if($pageid === 'logout'){
      require_once(__DIR__.'/../core/controllers/logout.php');
    }
    echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
    echo '<html>';
    echo '<head><meta http-equiv="Content-Type" content="text/html;charset=utf-8" />';
  //echo '<script src="public/js/config.js?v17" type="text/javascript"></script>';
    if(!require_once(__DIR__.'/../core/controllers/auth.php')){
//        var_dump($_COOKIE);
        require_once('views/partials/header.php');
        echo '<div ng-view>';
        require_once('views/loading.php');
        echo '</div>';
        require_once('views/partials/footer.php');
    } else {
        switch($pageid){
            case 'logout':
            //  require_once('views/widgets/externalnav.php');
                require_once(__DIR__.'/../core/controllers/logout.php');
                echo '<script>document.location = "/";</script>';
            break;
            
            default:
                require_once('internal_init.php');
        }
    }
    echo '</html>';
?>
