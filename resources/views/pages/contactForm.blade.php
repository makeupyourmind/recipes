<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo asset('css/contactForm.css')?>" type="text/css"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link href="http://fonts.fontstorage.com/import/poppins.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&amp;subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:700" rel="stylesheet">
    <title>Контакты</title>
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

    <div id = "success_message" hidden class="alert alert-success">
        <a id = "close" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        <strong>Внимание! </strong>Письмо успешно отправлено!
    </div>

<div class="contact">
  <div class="containerForm">
    <div class="title">
      <h1>Свяжитесь с нами</h1>
    </div>
    <div class="wrap">
      <form id = "myForm">
         <div class="input">
            <input id = "field-1" autofocus autocomplete="off" required type="text" id = "name" name="name" placeholder="Введите ваше имя">
            <input required class = "email" type="email" id = "email" name="email" placeholder="Введите ваш e-mail">
         </div>
         <div class="input">
           <input autocomplete="off" required type="text" id = "subject" name="subject" placeholder="Введите вашу тему">
         </div>
         <div class="textarea">
           <textarea autocomplete="off" required type="text" id = "msg"
           name="msg" placeholder="Ваше сообщение здесь..."></textarea>
         </div>
         <div class="btnSend">
           <button type="submit"
             class="send" id = "send" name="button">
             Отправить<i class="fas fa-long-arrow-alt-right"></i>
          </button>
         </div>
      </form>
    </div>
  </div>
</div>
  
  </body>

  <script>
    $('#myForm').submit(function(e){
        e.preventDefault();
        $('#success_message').removeAttr('hidden');
        $("#myForm").trigger('reset');
        setTimeout(function(){ $('#success_message').hide(); }, 3000);
        setTimeout(function(){ $('#success_message').show(); }, 50);
    });
  </script>

  <script>
      $('#close').click(function(e){
          $('#error_message').remove();
      });
  </script>

  <!-- <script>
		$(document).ready(function () {
		 $('input,textarea').focus(function(){
		   $(this).data('placeholder',$(this).attr('placeholder'))
		   $(this).attr('placeholder','');
		 });
		 $('input,textarea').blur(function(){
		   $(this).attr('placeholder',$(this).data('placeholder'));
		 });
		 });
	</script> -->

</html>
