<?php
//require_once(__DIR__.'/../core/controllers/auth.php');
$config = require(__DIR__.'/../core/config.php');

if($user){

    echo '<link rel="stylesheet" href="public/css/internal.css" />';
    echo '<div ng-controller="mainCtrl">';
    require_once('views/widgets/internalnav.php');

    echo '<div ng-view>';
    require_once('views/loading.php');
    echo '</div>';

    echo '</div>';
}
