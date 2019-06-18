<?session_start();?>
<!DOCTYPE html>
<html> 
<head>
    <meta charset="urf-8">
    <title>Медицинская карта</title>
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <link rel="stylesheet" href="css/main_page.css" type="text/css">
    <meta name="description" content="Сайт про котиков">
    <meta name="keywords" content="котики, собачки"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link href="img/2157b91a9977b19.ico" rel="shortcut icon" type="image/x-icon">
<!--    <link rel="stylesheet" href="css/fontawesome.min.css">-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    
  <script src="http://travistidwell.com/jsencrypt/bin/jsencrypt.js"></script>
    
</head>
<body>
    <div id="wrapper">
        <div id="content">
        <header>
            <div id="logo">
                <a href="http://medcard.ru/" title="На главную">
                    <img src="img/1523180132_logo.png">
                    <h1 style="display: inline-block; margin-left: 10px;position:relative;top: -5px;">медицинская карта</h1>
                </a> 
            </div> 


                <div id="registr" >
                    <a href="https://www.gosuslugi.ru/" title="Войти">
                        <div class="btn btn-info">
                            ГОСУСЛУГИ.РФ
                        </div>
                    </a>
                </div>
        </header>
         <nav>
             <div id="menuShow"><i class="fas fa-bars"></i></div>
             <div id="hideMenu">
                 <a href="">Новости</a>
                 <a href="">О портале</a>
                 <a href="">Пользователям</a>
                 <a href="">Помощь</a>
                 </div>
             <div id="search">
                 <span>Поиск</span>
                 <i class="fas fa-search"></i>
                 
             </div>
             <div id="mobilMenu">
                 <a href="">Новости</a>
                 <a href="">О портале</a>
                 <a href="">Пользователям</a>
                 <a href="">Помощь</a>
                 <hr>
                 <a href="">Регистрация</a>
                 <a href="">Войти</a>
             </div>
        </nav>
            <div style="clear:both;"></div>
         <div class="row row-margin-0" id="main_content_bg">  
             <div class="col-12 col-md-6 col-xl-8">
 
             </div>
             <div class="col-12 col-md-5 col-xl-3">
                <div class="reg-in">
                    <img src="https://gu-st.ru/st/img/logo_nobeta.0a1f5dfe6b.svg" alt="Госуслуги">
                    <form id ="login_form" onsubmit="showMessage()" action = "login.php" method="post">

                      <div class="form-group" >
                        
                        <label for="exampleInputEmail1">Введите email</label>
                        <input name ="login" type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                        <small style = "color:#dc3545;"id="emailHelp" class="form-text" >Вы можете войти только после регистрации на портале Госуслуги.рф</small>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Введите пароль</label>
                        <input name = "password" type="password" class="form-control" id="password" placeholder="Password">
                      </div>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Запомнить меня</label>
                      </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="doctor" value="yes">
                          <label class="form-check-label" for="defaultCheck1">
                            Я врач.
                          </label>
                        </div>
                      <button type="submit" id = "send_btn" class="btn btn-primary">Вход
                          
                        </button>
                    </form>                     
                </div>
             </div>

            </div>
        </div>

        
        <footer>
            <div id="site_name">
                <span>Государственный медицинский портал</span>
            </div>
            <div id="clear"></div>
            <div id="footer_menu">
                <a href="" title="Узнать про рекламу">Реклама</a>
                <a href="" title="Поддержать проект">Поддержать проект</a>
                <a href="" title="Написать письмо">Обратная связь</a>
            </div>
            <div id="rights">
                 <a href="">Все права защищены &copy; <?=date('Y')?></a>
            </div>
            <div id="social">
                <a href="" title="Группа Вк"><i class="fab fa-vk"></i></a>
                <a href="" title="Facebook"><i class="fab fa-facebook-square"></i></a>
                <a href="" title="Twitter"><i class="fab fa-twitter"></i></a>
            </div>
            
        </footer>
    </div>
    <!--   jQuery-->
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $('#menuShow').click(function (){
            if ($('#mobilMenu').is(':visible'))
                $('#mobilMenu').hide();
            else
                $('#mobilMenu').show();
        });
        
        $(document).scroll (function () {
            if ($(document).width() > 785){
            if ($(document).scrollTop() > $('header').height() + 10)
                $('nav').addClass('fixed');
            else
                $('nav').removeClass('fixed');
            }
        });
        
        window.onresize = function(event) {
            $('#mobilMenu').hide();
        };
        
        
//        шифрование
        
        function showMessage() {
                 var pub = "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDiXxKjoXywT8cOsXsAY8Qy99TvznFxvQEf2XrgddTBmFKBOilEio4CQF4VNNTqEF/HWvCcOhCKXNvko/uM0YrhxTQIGlUIxr1zJxTiznzhY3SZg6sDybykBMHU8n55PPwKskd6v34QvsuP8LxlkOpvQtdpZT7AXNa1L1XYlmmFTwIDAQAB";
                 var crypt = new JSEncrypt();
                 crypt.setPublicKey(pub);
                 var data = $('#email').val();
                 $('#email').val(crypt.encrypt(data));
                 var data2 = $('#password').val();
                 $('#password').val(crypt.encrypt(data2));      
        }
        
    </script>
    
</body>
</html> 

