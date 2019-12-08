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
    <link rel="stylesheet" href="<?php echo asset('css/signUp.css')?>" type="text/css"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link href="http://fonts.fontstorage.com/import/poppins.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&amp;subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:700" rel="stylesheet">
    <title>Регистрация</title>
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
        <strong>Внимание! </strong>Юзер с таким email уже зарегистрирован!
    </div>

    <div class="card">
        <div class="card-body">
        <div class="text">
            <h3 class = "title">Регистрация</h3>
        </div>
    <div class="all">
        <form action="" id = "sendForm">
            <div class="md-form">
                <input required autofocus autocomplete="off" type="text" id = "name" name="name" placeholder="Ваше имя">
            </div>

            <div class="md-form">
                <input required type="password" id = "password" name="password" placeholder="Ваш пароль">
            </div>

            <div class="md-form">
                <input required type="email" id = "email" name="email" placeholder="Ваш емейл">
            </div>

            <div class="row">

                <div class="button">
                    <button type="submit" id = "register" name="button">Зарегистрироватся</button>
                </div>

                <div class="col">
                    <p class="ch">Есть аккаунт?<a href="/login" class="terms">Войти</a></p>
                </div>
                
            </div>
        </form>
        <div id = "error"></div>
    </div>
</body>

    <script>

        $('#sendForm').submit(function(e){
            e.preventDefault();
            const name = $('#name').val();
            const password = $("#password").val();
            const email = $("#email").val();
            $.ajax({
                type: "POST",
                url: '/signUp',
                data: {
                    name,
                    password,
                    email
                },
                success: function(data)
                {
                    $('#email').val('');
                    if(data.success){
                        window.location = '/login';
                    }
                },
                error: function (data) {
                    $('#name').val('');
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