<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo asset('css/index.css')?>" type="text/css"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link href="http://fonts.fontstorage.com/import/poppins.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&amp;subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:700" rel="stylesheet">
    <title>Главная</title>
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

    <h2 class = "title">Все рецепты</h2>

    <div class ="select_div">
      <form class = "search_form" action = "/category" method="ANY">
        <select class = "custom_select" value = "" name="category_id" id = "category_id">
                <option disabled selected>Выберите свой вариант</option>
                @foreach ($categories as $key => $category)
                        <option value="{{$category->id}}">
                            {{$category->name}}
                        </option>
                @endforeach
        </select>
        
        <button class ="search_button" type = "submit" id = "search">Поиск</button>
      </form>
    </div>
    <!-- style = "float: right; margin-right: 40px; margin-top: 30px" class = "one" -->
    
    <div class = "pagination_my">
      {{ $recipes->links() }}
    </div>

    <div class = "card" id = "receipts" class = "receipts">
        @foreach ($recipes as $recipe)
            <div class = "card-info">
                <div class ="image_set">
                    <input type="image" width = "250" height = "200" id = "image" name="image"
                        src = "@if($recipe->image) /images/receipts/{{$recipe->image}} @endif" width="50" />
                </div>
              
                <div class="info_recipe">
                  <h4>Автор {{$recipe->user->name}}</h4>
                  <h4>Категория {{$recipe->category->name}}</h4>
                  <h4>Название {{$recipe->name}}</h4>
                </div>
                <div class = "buttons_block">
                    <div class = "rule">
                      <button class ="btn view_button"><a style = "color: white" href = "/users/{{$recipe->id}}">Посмотреть</a></button>
                    </div>
                </div>
            </div>
        @endforeach
        
    </div>
</body>
</html>