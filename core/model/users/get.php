<?php

if($key == "gV8uVD0Xum"){
    $stmnt = $db->prepare('select * from users where users._id=:id && user_type=:type');
    $stmnt->execute(array(':id' => $_COOKIE['secret2'], ':type' => $_COOKIE['type']));

    $user = $stmnt->fetchAll()[0];


    return $user;
}
