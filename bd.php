<?php
function print_res ($result){
    while ($row = $result->fetch_assoc()) {
        //print_r ($row);
        echo $row["name"]." ".$row["adress"];
        echo "<br/>";
    }
    echo "Кол-во записей = ".$result->num_rows."<br/>-----------------";
}

$host = 'localhost'; // адрес сервера 
$database = 'medcard'; // имя базы данных
$user = 'root'; // имя пользователя
$password = ''; // пароль
// подключаемся к серверу
//$mysqli = new mysqli ($host, $user, $password, $database); 

$mysqli = new PDO('mysql:host=localhost;dbname=medcard', $user, $password);


?>