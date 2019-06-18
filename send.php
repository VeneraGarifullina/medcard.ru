<?
session_start();
include "bd.php";

$act = $_GET['act'];

switch ($act){
    case 'addZapis':
        $jaloba = $_POST['jalobi'];
        $user_id = $_POST['id_user'];
        $doctor_id = $_POST['id_doctor'];
        $diagnoz = $_POST['diagnoz'];
        $rec = $_POST['recommend'];
        
        $reason = $_POST['reason'];
        $ot =$_POST['ot'];
        $date_start =$_POST['date_start'];
        $date_end =$_POST['date_end'];
        /*Загрузка файла*/
        if ($_FILES['file']['size']!=0){
            $uploaddir = 'files/vlojeniya/';
            $type_file = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $current_date = date("Y-m-d_H-i-s");  
            $new_name=$user_id."_".$current_date.".".$type_file;
            $uploadfile = $uploaddir . $new_name;

            if (!move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                echo "Файл не загружен, повторите попытку!\n";
                exit();
            }
        }else{
            $uploadfile=NULL;
        }
        
         /*загрузка данных справки*/
        $name_doctor = $mysqli->prepare("SELECT name FROM doctor WHERE id = :doctor_id");
        $name_doctor->execute([':doctor_id' => $doctor_id]);
        
        $name_doctor = $name_doctor->fetch(PDO::FETCH_ASSOC)["name"];
        if (!empty($reason)){
            $sql2 = $mysqli->prepare("INSERT INTO spravka (ot, reason, date_start, date_end, name_doctor) VALUES (:ot, :reason,:date_start, :date_end, :name_doctor)");
            $sql2->execute([':ot' => $ot, ':reason' => $reason, ':date_start' => $date_start, ':date_end' => $date_end,':name_doctor' => $name_doctor ]);
        }
        
        
        /*добавление записи в журнал*/
        if (!empty($reason)){
            $sql = $mysqli->prepare("INSERT INTO journal (id_user, id_doctor, complaints, diagnoz,data_priema, recommend, PDF, spravka) VALUES (:user_id, :doctor_id, :jaloba, :diagnoz, CURRENT_DATE(), :rec, :uploadfile, :last_id)");
            
            $sql->execute([':user_id' => $user_id, ':doctor_id' => $doctor_id, ':jaloba' => $jaloba, ':diagnoz' => $diagnoz,':rec' => $rec, ':uploadfile' => $uploadfile,':last_id'=> $mysqli->lastInsertId() ]);
        }
        else {
            
             $sql = $mysqli->prepare("INSERT INTO journal (id_user, id_doctor, complaints, diagnoz,data_priema, recommend,PDF) VALUES (:user_id, :doctor_id, :jaloba, :diagnoz, CURRENT_DATE(),:rec, :uploadfile)");

             $pdo = $sql->execute([':user_id' => $user_id, ':doctor_id' => $doctor_id, ':jaloba' => $jaloba, ':diagnoz' => $diagnoz, ':rec' => $rec, ':uploadfile' => $uploadfile ]);
            
//                         print_r($sql->errorInfo());
//             echo $sql->errorCode();
            
        }
       
        
        header("location: {$_SERVER['HTTP_REFERER']}");
        
        
    break;
    case 'logout':
        unset($_SESSION['DOCTOR_ID']);
        unset($_SESSION['DOCTOR_NAME']);
        unset($_SESSION['USER_ID']);
        unset($_SESSION['USER_NAME']);
        header("location: index.php");
        
        
    break;
        
    
}