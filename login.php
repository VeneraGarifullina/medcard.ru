<?
session_start();
include "bd.php";
$key =<<<SOMEDATA777
-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQDiXxKjoXywT8cOsXsAY8Qy99TvznFxvQEf2XrgddTBmFKBOilE
io4CQF4VNNTqEF/HWvCcOhCKXNvko/uM0YrhxTQIGlUIxr1zJxTiznzhY3SZg6sD
ybykBMHU8n55PPwKskd6v34QvsuP8LxlkOpvQtdpZT7AXNa1L1XYlmmFTwIDAQAB
AoGAQXnWXlX7RtQMc4eKWFaDDWr5wFMqJQfSJ3A0RnBOlaCFXLOB9D1PTf9oNyIM
45bQ3UzEg6uX1S1+vOdhfx2s2Y1ee3UwMqSUpWDvCVyBBDrfiH+OMIqhvA/QZqsc
Eyw9kx0YeJmmSrK1bbiFkE8khzCZaKjGuqARIFI8jD27/yECQQD6ZAeEVH41nPKH
+Bo8TUSawcPmOQMdz6ZAzDPlbKlT8M4NU7RQPVFCVgEpPXXlNy6mMwRcy+z2Qhp+
vRjSxsc9AkEA53FLWpW/EEycNE9C0vpI8lnfTABKIKHCYHLeGZ6AxFq1c14eBq97
5NLl8OJ7yeLP9x4Hw+fXQJufIMi9P5unewJBAJTAVE7jO09yfAsW888bQESIFG9z
M0zEjco1BieoFDhP+LmmHpsEsn+sRGhRoPaZf9cwu8i9RXtO7hqZEGQ3vykCQAWo
TVE/i9YYKVFWBqolmBbkf4LaFvXJPnkhFbDGoRsrpHfXeyBqtbqYNSq4PpJmyvKd
d08gobBgnXktrwKZCXUCQQDDPbrAS06e4keB+CsN7rUjg9GDzgFm+f8XcTWPufFD
/WhBE0A/4Fbb9itPzb2vgFLHs5KVXPY+gmv753MMqNRJ
-----END RSA PRIVATE KEY-----
SOMEDATA777;
$login = $_POST["login"];
$password = $_POST["password"];
$pk  = openssl_get_privatekey($key);
openssl_private_decrypt(base64_decode($login), $login, $pk);
openssl_private_decrypt(base64_decode($password), $password, $pk);

if(isset($_POST['doctor']) && 
   $_POST['doctor'] == 'yes') 
{
    
    
    $sql = $mysqli->prepare("SELECT id,name,password FROM doctor WHERE login = :login ");
    $sql->execute([':login' => $login]);
    if ($sql->rowCount() == 0){
        echo "не сущ";
        header("location: index.php");
    }
    else{
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        if (md5($password) == $result["password"]){
            $_SESSION['DOCTOR_ID']=true;
            $_SESSION['DOCTOR_ID']=$result["id"];
            $_SESSION['DOCTOR_NAME']=$result["name"];
            header("location: profil_doc.php");
        }else{
            echo "Пароль неверный ыыы.";
        }

    }
}
else
{
   $sql = $mysqli->prepare("SELECT id,name,password FROM user WHERE login = :login");
    $sql->execute([':login' => $login]);
    if ($sql->rowCount() == 0){
        echo "не сущ";
        header("location: index.php");
    }
    else{
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        if (md5($password) == $result["password"]){
            $_SESSION['USER_ID']=true;
            $_SESSION['USER_ID']=$result["id"];
            $_SESSION['USER_NAME']=$result["name"];
            header("location: profil.php");
        }else{
            echo "Пароль неверный.";
        }
        
    }
}




//
//
//$sql = $mysqli->query("SELECT id,name,password FROM user WHERE login = '$login'");
//if ($sql->num_rows == 0){
//    echo "не сущ";
//    header("location: index.php");
//}
//else{
//    $result = $sql->fetch_array();
//    if (md5($password) == $result["password"]){
//        $_SESSION['USER_ID']=true;
//        $_SESSION['USER_ID']=$result["id"];
//        $_SESSION['USER_NAME']=$result["name"];
//        header("location: profil.php");
//    }else{
//        echo "Пароль неверный.";
//    }
//
//}

?>