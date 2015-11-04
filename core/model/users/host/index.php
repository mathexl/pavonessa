<?php
if($key == "gV8uVD0Xum"){
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $statement = $db->prepare("select _cid from college where :email RLIKE(email_root)");
            $statement->execute(array(':email' => $email));
            $row = $statement->fetch();
            $doc = [
                '_hid' => $_id,
                'major' => $_POST['major'],
                'yearid' => $_POST['yearid'],
                'badges' => json_encode($_POST['badges']),
//                ':hometown' => $_POST['hometown'],
//               ':highschool' => $_POST['highschool'],
                'biography' => json_encode($_POST['biography']),
                'tags' => json_encode($_POST['tags']),
                'bday' => $_POST['bday'],
                '_cid' => $row['_cid']
            ];

//        print_r($doc);
//        if(isset($_POST['_id'])){
//            unset($_POST['_id']));
//        }



        try {
            // create new entry. This statement should only be triggered if this file is called from a signup event
            $stmnt = $db->prepare('insert into host (_hid, _cid) values (:hid,:cid) on duplicate key update major=:major,yearid=:yearid,achievements=:badges,biography=:biography,tags=:tags,bday=:bday');
//            echo $sql;
            if($row = $stmnt->execute([':hid'=>$doc['_hid'], ':cid'=>$doc['_cid'],':major'=>$doc['major'],':yearid'=>$doc['yearid'],':badges'=>$doc['badges'],':biography'=>$doc['biography'],':tags'=>$doc['tags'],':bday'=>$doc['bday']])){
                return $doc;
            } else {
              /*  echo 'failed';
                // user already exists, so this is an update request
                $stmnt = $db->prepare("UPDATE host SET  on duplicate key update major=:major,yearid=:yearid,badges=:badges,biography=:biography,tags=:tags,bday=:bday");
                if($stmnt->execute([':major'=>$doc['major'],':yearid'=>$doc['yearid'],':badges'=>$doc['badges'],':biography'=>$doc['biography'],':tags'=>$doc['tags'],':bday'=>$doc['bday']])){
                    $status = $errcodes[0];
                    $status['_hid'] = $_id;
                    return $doc;
                } else {
                    $status = $errcodes[2];
                    $status['_hid'] = $_id;
                    return $errcodes[2];
                }
                  */
            };
        } catch (PDOException $e){

        }

        return;
        break;

        case 'GET':
        //    echo 'select email, user_type, fname, lname,propic, host.*, college.cname from users inner join host on users._id = host._hid inner join college on host._cid=college._cid where college._cid = ' . $_GET['_cid'] . ' && host._hid != "' .  $_COOKIE['secret2'] . '" ' .'limit '.($offset ? $offset : 0).','.($limit ? $limit : 6);
            if($_GET['_cid']){
              $stmnt = $db->prepare('select users.*, host.*, college.* from users inner join host on users._id = host._hid inner join college on host._cid=college._cid where college._cid = ' . $_GET['_cid'] . ' && host._hid != "' .  $_COOKIE['secret2'] . '" ' .'limit '.($offset ? $offset : 0).','.($limit ? $limit : 6)  );
            } else {
              $stmnt = $db->prepare('select users.*, host.*, college.* from users inner join host on users._id = host._hid inner join college on host._cid=college._cid where 1=1 '.implode(' ', array_map(function ($v, $k) { return sprintf("&& %s='%s'", $k, $v); }, array_values($_GET), array_keys($_GET))).'order by cnumhosts desc limit '.($offset ? $offset : 0).','.($limit ? $limit : 6)  );
            }
        //    $stmnt = $db->prepare('select email, user_type, fname, lname,propic, host.*, college.cname from users inner join host on users._id = host._hid inner join college on host._cid=college._cid where 1=1 '.implode(' ', array_map(function ($v, $k) { return sprintf("&& %s='%s'", $k, $v); }, array_values($_GET), array_keys($_GET))));


            $stmnt->execute();
            return $stmnt->fetchAll();
        break;

    }
}
