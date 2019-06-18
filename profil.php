<?
session_start();
if (!isset($_SESSION['USER_ID'])){
    header("location: index.php");
}
require "bd.php";
require "templates/head.php";
$id_user = $_SESSION['USER_ID'];
$sql = $mysqli->prepare("SELECT * FROM user WHERE id = :id_user ");
$sql->execute([':id_user' => $id_user]);
$result = $sql->fetch(PDO::FETCH_ASSOC);
$table= $mysqli->prepare("SELECT journal.*,doctor.name FROM journal JOIN doctor ON journal.id_doctor = doctor.id WHERE journal.id_user = :id_user ORDER by journal.data_priema DESC");
$table->execute([':id_user' => $id_user]);

?>
   <body>
    <div id="wrapper">
        <div id="content">
            <?require "templates/header.php"?>
             <div class="row row-margin-0" id="profil_img">  
                 <div class="col-3">
                    <div class="profile_block_left">
                        <div class="card" >
                              <img class="card-img-top" src="img/ted.jpg" alt="Card image cap">
                              <div class="card-body">
                                <h5 class="card-title">ФИО: <?=$_SESSION['USER_NAME'];?></h5>
                                <p class="card-text">Дата рождения: <?=$result["birth_date"]?></p>
                              </div>
                              <ul class="list-group list-group-flush">
                                <li class="list-group-item">Страховой полис: <?=$result["strah_polis"]?></li>
                                <li class="list-group-item">Адрес: <?=$result["adress"]?></li>
                              </ul>
                            </div>
                     </div>

                 </div>
                 <div class="col-9">
                     <div class="table_block ">
                         В таблице показаны ваши обращения к врачу
                         <div class="alert alert-primary" role="alert">
                          Добро пожаловать, <?= $_SESSION['USER_NAME']?>
                        </div>
                        <table class="table table-hover">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col">#</th> 
                              <th scope="col">Дата приема</th> 
                              <th scope="col">Жалобы</th>
                              <th scope="col">Заболевание</th>
                              <th scope="col">Рекомендации к лечению</th>
                              <th scope="col">Врач</th>
                              <th scope="col">Справка</th>
                              <th scope="col">Приложения</th>
                            </tr>
                          </thead>
                          <tbody >
                          <? $i=1;
                            while ($row = $table->fetch(PDO::FETCH_ASSOC)) {?>
                            <tr>
                              <th scope="row"><?=$i?></th>
                              <td><?=$row["data_priema"]?></td>  
                              <td><?=$row["complaints"]?></td>
                              <td><?=$row["diagnoz"]?></td>
                              <td><?=$row["recommend"]?></td>
                              <td><?=$row["name"]?></td>
                              <td><? if(($row["spravka"])!=0){?>
                                    <a href="spravka_gen.php?id=<?=$row["id"]?>">
                                      <img src="img/doc.png" style="width:35px; height:37px">
                                    </a> 
                                 <?}?>
                              </td>
                                
                              <td>
                                  <? if(($row["PDF"])!=NULL){?>
                                      <a href="http://medcard.ru/<?=$row["PDF"]?>">
                                      <img src="img/77.png" style="width:35px; height:37px">
                                  </a> 
                                  <?}?>
                              </td>
                            </tr>
                              

                          <? $i =$i+1;};
                                  ?>

                          </tbody>
                        </table>
                     </div>
                     
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
