<?php
if($key == "gV8uVD0Xum"){
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':

            $doc = [
                '_pid' => $_id,
                'highschool' => $_POST['highschool'],
                'intmajor' => $_POST['major'],
                'gradyear' => $_POST['yearid'],
                'prefs' => $_POST['prefs']
            ];
//            print_r($doc);
            // create new entry. This statement should only be triggered if this file is called from a signup event
        try {
            $stmt = $db->prepare('insert into prospie (_pid) values (:pid) on duplicate key update prospie set highschool=:highschool, intmajor=:intmajor, gradyear=:gradyear where _pid=:pid');
            if($stmt->execute([':pid'=>$doc['_pid'],':highschool'=>$doc['highschool'], ':intmajor'=>$doc['intmajor'], ':gradyear'=>$doc['gradyear']])){
                return $doc;
            } else {
                // user already exists, so this is an update request
//                $stmnt = $db->prepare('update prospie set highschool=:highschool, intmajor=:intmajor, gradyear=:gradyear where _pid=:pid');
//                if($stmnt->execute(array(':highschool'=>$doc['highschool'], ':intmajor'=>$doc['intmajor'], ':gradyear'=>$doc['gradyear'], ':pid'=>$doc['_pid']))){
//                    $status = $errcodes[0];
//                    $status['_id'] = $_id;
//                    return $doc;
//                } else {
//                    $status = $errcodes[2];
//                    $status['_id'] = $_id;
//                    return $errcodes[2];
//                }

            };
        } catch (PDOException $e){

        }

        break;

        case 'GET':
            $stmnt = $db->prepare('select email, user_type, fname, lname, accountsetup, prospie.* from users inner join prospie on users._id = prospie._pid where 1=1 '.implode(' ', array_map(function ($v, $k) { return sprintf("&& users.%s='%s'", $k, $v); }, array_values($_GET), array_keys($_GET))));
            $stmnt->execute();
            return $stmnt->fetchAll();
        break;
    }
}
