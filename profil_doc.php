<?
session_start();
if (!isset($_SESSION['DOCTOR_ID'])){
    header("location: index.php");
}
require "bd.php";
require "templates/head.php";
$id_doctor = $_SESSION['DOCTOR_ID'];
$sql = $mysqli->prepare("SELECT * FROM doctor WHERE id = :id_doctor");
$sql->execute([':id_doctor' => $id_doctor]);
$result = $sql->fetch(PDO::FETCH_ASSOC);

?>
<body>
    <div id="wrapper">
        <div id="content">
            <?require "templates/header.php"?>
             <div class="row row-margin-0" id="profil_img">  
                 <div class="col-2">
                    <div class="profile_block_left">
                        <div class="card" >
                              <img class="card-img-top" src="img/doc.jpg" alt="Card image cap">
                              <div class="card-body">
                                <h5 class="card-title">ФИО: <?=$_SESSION['DOCTOR_NAME'];?></h5>
                              </div>
                              <ul class="list-group list-group-flush">
                                <li class="list-group-item">Стаж: <?=$result["experience"]?></li>
                                <li class="list-group-item">Специальность: <?=$result["specialty"]?></li>
                              </ul>
                            </div>
                     </div>

                 </div>
                 <div style="padding-left:0px;" class="col-10">
                     <blockquote class="blockquote">
                        <p class="mb-0">Добро пожаловать в систему, <?=$_SESSION['DOCTOR_NAME'];?>! Мы рады приветствовать Вас на государственном медицинском портале. Для плучения данных пациента в специальной форме введите номер Страхового Медицинского Полиса пациента и нажмите кнопку "Поиск". После заполнения данных и нажатия кнопки "Сохранить", введенные данные изменить будет нельзя. Внимательно проверяйте данные перед отправкой!
                         </p>
                     </blockquote>
                     <form class="form-inline" action = "doctor.php" method="get">
                      <div class="form-group mb-2">
                        <label for="staticEmail2" class="sr-only">Email</label>
                          <div>Введите номер страхового полиса пациента</div>
                      </div>
                      <div class="form-group mx-sm-3 mb-2">
                        <label for="inputPassword2" class="sr-only"></label>
                        <input type="text" class="form-control" name="strah" placeholder="">
                      </div>
                      <button style="background-color:#6cb97d; border-color:#6cb97d;" type="submit" class="btn btn-primary mb-2">Поиск</button>
                    </form>
                     
                 </div>
            </div>
            
             <div class="row row-margin-0" id="profil_img">  
                 <div class="col-3">

                    
                 </div>
                <div class="col-9">

                 </div>
            </div>


        </div>
    </div>
</body>
