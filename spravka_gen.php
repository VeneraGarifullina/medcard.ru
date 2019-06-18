<?
session_start();

require "bd.php";
header("Content-type: image/png");
$id_zapisi = $_GET['id'];
$sql = $mysqli->prepare("SELECT * FROM journal WHERE id = :id_zapisi ");
$sql->execute([':id_zapisi' => $id_zapisi]);
    $result = $sql->fetch(PDO::FETCH_ASSOC);
$sql2 = $mysqli->prepare("SELECT * FROM spravka WHERE id = :id ");
$sql2->execute([':id' => $result['spravka']]);
    $result2 = $sql2->fetch(PDO::FETCH_ASSOC);
$user = $mysqli->prepare("SELECT * FROM user WHERE id = :id_us");
$user->execute([':id_us' => $result['id_user']]);
    $result3 = $user->fetch(PDO::FETCH_ASSOC);

if (!isset($_SESSION['DOCTOR_ID'])){
    if($_SESSION['USER_ID']!= $result['id_user'])
        header("location: index.php");
}
$fio= $result3['name'];
$date=$result3['birth_date'];
$ot = $result2['ot'];
$reason = $result2['reason'];
$c = $result2['date_start'];
$po = $result2['date_end'];
$doctor = $result2['name_doctor'];
$date_take = $result['data_priema'];


$im = imagecreatefrompng("img/spravka2.png");
$black = imagecolorallocate($im, 20, 20, 20);
$text_size=18;
$font = 'arial.ttf';

imagettftext($im, $text_size, 0, 648, 70, $black, $font, $id_zapisi);
imagettftext($im, $text_size, 0, 210, 185, $black, $font, $fio);
imagettftext($im, $text_size, 0, 306, 235, $black, $font, $date);
imagettftext($im, $text_size, 0, 108, 336, $black, $font, $ot);
imagettftext($im, $text_size, 0, 108, 428, $black, $font, $reason);
imagettftext($im, $text_size, 0, 125, 490, $black, $font, $c);
imagettftext($im, $text_size, 0, 410, 490, $black, $font, $po);
imagettftext($im, $text_size, 0, 192, 576, $black, $font, $doctor);
imagettftext($im, $text_size, 0, 778, 672, $black, $font, $date_take);



imagepng($im);
imagedestroy($im);

?>