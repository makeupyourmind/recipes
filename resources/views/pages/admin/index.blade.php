<!DOCTYPE html>
<html lang="en">
@if(!Session::get('user'))
<script>window.location = "/login";</script>
@endif
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo asset('css/receipt_index.css')?>" type="text/css"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link href="http://fonts.fontstorage.com/import/poppins.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&amp;subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:700" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <header class="site-header">
       <div class="container">

         <a href="/" class="logo">Laravel</a>
         
           <nav class="header-menu">
              <ul class="inline">
                <li><a href="/recipes/create">Создать рецепт</a></li>
                <li><a href="/recipes">Все рецепты</a></li>
                <li><a href="/contact">Контакты</a></li>
              </ul>
           </nav>

       </div>
    </header>

    <div class = "cust">
      <div class = "exit">
        <button class = "exit_button" id = "exit">Выйти</button>
      </div>
    </div>


    <div class ="select_div">
      <form class = "search_form" action = "/recipes/category" method="ANY">
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
    <h2 class = "title">Все рецепты</h2>

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
                      <button class ="btn view_button"><a style = "color: white" href = "/recipes/{{$recipe->id}}">Редактировать</a></button>
                      {!! Form::open(['method' => 'DELETE', 'route' => ['recipes.destroy', $recipe->id]]) !!}
                      {!! Form::submit("Удалить", ['class' => 'btn delete_button']) !!}
                      {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endforeach
        
    </div>
</body>

<script>
  $('#category_id').click(function(e){
    const category_id = $("#category_id option:selected" ).val();
    $('#category_id').attr('value', category_id);
    console.log(category_id);
  })
</script>


<script>
    $('#exit').click(function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/logout',
            success: function(data)
            {
                window.location = '/';
            }
        });
    })
</script>

</html>