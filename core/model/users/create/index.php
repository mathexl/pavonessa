<?php
if($key == "gV8uVD0Xum"){

    $doc = [
        'email' => $_POST['email'],
        'pw' => md5($_POST['pw']),
        'user_type' => $_POST['user_type'],
        '_id' => md5($_POST['email']),
        'fname' => ($_POST['fname']),
        'lname' => ($_POST['lname']),
        'session_id' => md5(time() . $_POST['email'] . $_POST['pw'])
    ];

    $sql = "INSERT INTO users (".implode(",",array_keys($doc)).") VALUES ('".implode("','",array_values($doc))."')";
//            echo $sql;
    if($db->exec($sql)){
        $status = $errcodes[4];
        $status['_id'] = $_POST['email'];
        return $doc;
    } else {
        $status = $errcodes[1];
        $status['_id'] = $_POST['email'];
        return $status;

    };
} elseif ($key == "a8sadhD0asd"){
    $auth_code = md5($_POST['email']);
    $doc = [
        'email' => $_POST['email'],
        'pw' => md5($_POST['pw']),
        'user_type' =>
        $_POST['user_type'],
        '_id' => $auth_code,
        'fname' => ($_POST['fname']),
        'lname' => ($_POST['lname']),
        'accountsetup' => -1
    ];

    $sql = "INSERT INTO users (".implode(",",array_keys($doc)).") VALUES ('".implode("','",array_values($doc))."')";
//            echo $sql;
    if($db->exec($sql)){
        $status = $errcodes[4];
        $status['_id'] = $_POST['email'];
        return $doc;
    } else {
        $status = $errcodes[1];
        $status['_id'] = $_POST['email'];
        return $status;

    };
} elseif ($key == "xVasadaaD0Xum"){

    $_id = $_POST['id'];


    $statement = $db->prepare("select user_type, email, pw from users where _id = :id");
    $statement->execute(array(':id' => $_id));
    $row = $statement->fetch();

    $user_type = $row['user_type'];
    $email = $row['email'];
    $pw = $row['pw'];

    $statement = $db->prepare("select _cid, cname from college where :email RLIKE(email_root)");
    $statement->execute(array(':email' => $email));
    $row = $statement->fetch();
    $_cid = $row['_cid'];
    $cname = $row['cname'];


    $doc = [
        'session_id' => md5(time() . $_POST['email'] . $_POST['pw']),
        'accountsetup' => 0,
        '_id' => $_id,
        'user_type' => $user_type
    ];


    $_POST['_cid'] = $_cid;

//    print_r($doc);



    $statement = $db->prepare("UPDATE users SET session_id=:session_id, accountsetup=:accountsetup, user_type=:user_type, _cid=:_cid WHERE _id=:id");
//            echo $sql;
    if($statement->execute(array(':session_id'=>$doc['session_id'], ':accountsetup'=>0, ':user_type'=>$doc['user_type'], ':_cid' =>$_cid, ':id'=>$doc['_id']))){
        $status = $errcodes[4];
        $status['_id'] = $_POST['email'];
        return $doc;
    } else {
        $status = $errcodes[1];
        $status['_id'] = $_POST['email'];
        return $status;
    };
}
