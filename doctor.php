<?
session_start();
if (!isset($_SESSION['DOCTOR_ID'])){
    header("location: index.php");
}
require "bd.php";
require "templates/head.php";
$strah = $_GET["strah"];
$user = $mysqli->prepare("SELECT * FROM user WHERE strah_polis = :strah");
$user->execute([':strah' => $strah]);
$result = $user->fetch(PDO::FETCH_ASSOC);
$table= $mysqli->prepare("SELECT journal.*,doctor.name FROM journal JOIN doctor ON journal.id_doctor = doctor.id WHERE journal.id_user = :id_user ORDER by journal.data_priema DESC");
$table->execute([':id_user' => $result['id']]);

$filee = $mysqli->prepare("SELECT PDF FROM journal WHERE id_user = :id_user");
$filee->execute([':id_user' => $result['id']]);

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
                                <h5 class="card-title">ФИО: <?=$result["name"]?></h5>
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
                        <blockquote class="blockquote">
                            <p class="mb-0">После заполнения данных и нажатия кнопки "Сохранить", введенные данные изменить будет нельзя. Внимательно проверяйте данные перед отправкой!
                            </p>
                            
                             <button type="button"  class="btn btn-warning" data-toggle="modal" data-target="#myModal">Новая запись</button>
                                
                          
                                                       
                         </blockquote>
                        
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
                              <td>
                                  <? if(($row["spravka"])!=0){?>
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


       
       


<!-- Модальное окно -->  
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Пациент: <?=$result["name"]?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action = "send.php?act=addZapis" enctype="multipart/form-data" method="post"> 
      <div class="modal-body">
  
              <label>Жалобы:</label>
              <input type="hidden" name="id_user" value="<?=$result["id"]?>">
              <input type="hidden" name="id_doctor" value="<?=$_SESSION['DOCTOR_ID']?>">
              <input type="text" class="form-control" name="jalobi">
              <label>Диагноз:</label>
              <input type="text" class="form-control" name="diagnoz">
              <label>Рекомендации к лечению</label>
              <input type="text" class="form-control" name="recommend">
              <button type="button" class="btn btn-warning" style="margin:10px;">Сформировать справку</button>
              <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
              <input type="file" class="btn btn-info" name="file"id="file" title="Результаты анализов" style="margin:10px;">
             
              <label>Причина:</label>
              <input type="text" class="form-control" name="reason">
              <label>От(работа/учеба/занятия физ.культурой)</label>
              <input type="text" class="form-control" name="ot">
              <div class="row" style="margin-top: 10px">
                  <div class="col">
                      <input type="date" class="form-control" placeholder="Дата начала" name = "date_start">
                  </div>
                  <div class="col">
                      <input type="date" class="form-control" placeholder="Дата окончания" name = "date_end">
                  </div>
              </div>
 
      </div>
        
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Закрыть</button>
        <button type="submit" class="btn btn-primary" >Сохранить</button>
      </div>
    </form>
    </div><!-- /.модальное окно-Содержание -->  
  </div><!-- /.модальное окно-диалог --> 
</div>    
       
       

       
       

       
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" ></script>
<script src="js/bootstrap/bootstrap.min.js"></script>  
</body>
