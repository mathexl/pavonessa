<?php
if($key == "gV8uVD0Xum"){
    $stmnt = $db->prepare('
        SELECT * FROM auth WHERE 
            session_id=:sessionid && _id=:id && user_type=:type
    ');
    $stmnt->execute(array(':sessionid' => $_COOKIE['secret1'], ':id' => $_COOKIE['secret2'], ':type' => $_COOKIE['type']));
    return $stmnt->fetchAll()[0];
}

