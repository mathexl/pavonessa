<?php
if($key == "gV8uVD0Xum"){
    $stmnt = $db->prepare('select * from users where email=:email && pw=:pw');
    $stmnt->execute(array(':email' => $email, ':pw' => $pw));
    if($stmnt->rowCount()){
        $status = $errcodes[0];
        $status['_id'] = $email;
        $doc = $stmnt->fetchAll()[0];
        $doc['session_id'] = md5(time().$email.$pw);
        $db->exec('update users set session_id="'.md5(time().$email.$pw).'" where _id="'.$doc['_id'].'"');
        return $doc;
    } else {
        $status = $errcodes[3];
        $status['_id'] = $email;
        return $status;
    }
}
