<!DOCTYPE html>
<html lang="en">
@if(Session::get('user'))
<script>window.location = "/recipes";</script>
@endif
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="<?php echo asset('css/login.css')?>" type="text/css"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link href="http://fonts.fontstorage.com/import/poppins.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&amp;subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:700" rel="stylesheet">
    <title>Вход в систему</title>
</head>
<body>
    <header class="site-header">
        <div class="container">

            <a href="/" class="logo">Laravel</a>

            <nav class="header-menu">
                <ul class="inline">
                    <li><a href="/recipes">Добавить рецепт</a></li>
                    <li><a href="/login">Войти</a></li>
                    <li><a href="/signUp">Регистрация</a></li>
                    <li><a href="/contact">Контакты</a></li>
                </ul>
            </nav>

        </div>
    </header>

    <div id = "error_message" hidden class="alert alert-danger">
        <a id = "close" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        <strong>Внимание! </strong>Данные введены не верно!
    </div>

    <div class="card">
        <div class="card-body">
        <div class="text">
            <h3 class = "title">Войти</h3>
        </div>
        <div class="all">
            <form action="" id = "sendForm" method = "post">
                @csrf
                <div class="md-form">
                    <input autofocus required type="password" id = "password" name="password" placeholder="Ваш пароль">
                </div>

                <div class="md-form">
                    <input required autocomplete="on" id = "email" type="email" name="email" placeholder="Ваш емейл">
                </div>

                <div class="row">

                    <div class="button">
                        <button type="submit" name="button">Войти</button>
                    </div>

                    <div class="col">
                        <p class="ch"><a href="/signUp" class="terms">Нет аккаунта?</a></p>
                    </div>

                </div>
            </form>
            <div id = "error"></div>
        </div>
    </div>

    <div class="footer">
       <div class="footer-text">
         <p class="ch">Или войти с помощью:</p>
       </div>
       <div class="icons">
          <!--Facebook-->
          <a class="fa-lg p-2 m-2 fb-ic">
            <i class="fab fa-facebook-f white-text fa-lg"> </i>
          </a>
          <!--Twitter-->
          <a class="fa-lg p-2 m-2 tw-ic">
            <i class="fab fa-twitter white-text fa-lg"> </i>
          </a>
          <!--Google +-->
          <a class="fa-lg p-2 m-2 gplus-ic">
            <i class="fab fa-google-plus-g white-text fa-lg"> </i>
          </a>
      </div>
     </div>
   </div>

</body>

    <script>
        $('#sendForm').submit(function(e){
            e.preventDefault();
            const password = $("#password").val();
            const email = $("#email").val();
            $.ajax({
                type: "POST",
                url: '/login',
                data: {
                    password,
                    email
                },
                success: function(data)
                {
                    localStorage.setItem('user', true);
                    $('#email').val('');
                    if(data.success){
                        window.location = '/recipes';
                    }
                },
                error: function (data) {
                    $("#password").val('');
                    $("#email").val('');
                    $('#error_message').removeAttr('hidden');
                    setTimeout(function(){ $('#error_message').hide(); }, 3000);
                    setTimeout(function(){ $('#error_message').show(); }, 50);   
                }
            });
        });

    </script>

    <script>
        $('#close').click(function(e){
            $('#error_message').remove();
        });
    </script>

</html>