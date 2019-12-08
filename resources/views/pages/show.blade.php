<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo asset('css/receipt_show.css')?>" type="text/css"> 
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
                <li><a href="/">Все рецепты</a></li>
              </ul>
           </nav>
       </div>
    </header>

    <div class = "container-group">

        <div class = "image_header">
            <div class = "image">
                <input type="image" width = "400" height = "230" id = "image" name="image"
                    src = "@if($recipe->image) /images/receipts/{{$recipe->image}} @endif" width="50">
            </div>
        </div>

        <!-- <div class = "image-group">
            <div class = "image-group1">
                <form id = "sendForm">
                    <div style = "float: right">
                        <input type="file" name="pic" id = "file" accept="image/*">
                    </div>
                    <div style = "float: left">
                        <input type="submit" value = "Загрузить">
                    </div>
                </form>
            </div>
        </div> -->

        <form id = "updateForm">
            <!-- <div class = "button_field">
                <div>
                    <button type = "button" class = "create_button" id = "addIngredient">Добавить ингредиенты</button>
                </div>
                <div>
                    <button class = "create_button" type = "submit">Обновить</button>
                </div>
            </div> -->
            
            <div class = "recipe-group-1">
                <div class = "recipe-key-1">
                    <p class = "p">Автор</p>
                </div>
                <div class = "container-recipe">
                    <input readonly id = "author" type="text" value = "{{$recipe->user->name}}">
                </div>
            </div>
        
        <!-- {!! Form::model($recipe, array('route' => array('recipes.update', $recipe->id ), 'method' => 'PUT' )) !!}
         -->
         
            <div id = "input_group">
                
                <div class = "recipe-group-1">
                    <div class = "recipe-key-1">
                        <p class = "p">Имя</p>
                    </div>
                    <div class = "container-recipe">
                        <input readonly name = "name" id = "name" type="text" value = "{{$recipe->name}}">
                    </div>
                </div>
                
                <div class = "recipe-group-1">
                    <div class = "recipe-key-1">
                        <p class = "p">Время приготовления</p>
                    </div>
                    <div class = "container-recipe">
                        <input readonly name = "cooking" id ="cooking" type="text" value = "{{$recipe->cooking}}">
                    </div>
                </div>


                <div class = "recipe-group-1">
                    <div class = "recipe-key-1">
                        <p class = "p">Пищевая ценность</p>
                    </div>
                    <div class = "container-recipe">
                        <input readonly name = "nutritionalValue" id = "nutritionalValue" type="text" value = "{{$recipe->nutritionalValue}}">
                    </div>
                </div>

                <div class = "recipe-group-1">
                    <div class = "recipe-key-1">
                        <p class = "p">Описание</p>
                    </div>
                    <div class = "container-recipe">
                        <textarea readonly cols = "34" rows = "5" name = "description" id = "description" type="text" value = "{{$recipe->description}}">{{$recipe->description}}</textarea>
                    </div>
                </div>

                <div style = "margin-top: 60px">
                    <p style = "text-align: center;">Ингредиенты</p>
                </div>
                
                @foreach($recipe->ingredients as $key => $ingredient)
                    <div class = "recipe-group-1">
                        <div class = "recipe-key-1">
                            <input readonly class = "p" value = "{{$key}}" name = 'ingredients_key' id = 'ingredients_key'>
                        </div>
                        <div class = "container-recipe">
                            <input readonly type="text" value = "{{$ingredient}}" name = 'ingredients_value' id = 'ingredients_value'></input>
                        </div>
                    </div>
                @endforeach
            </div>
           
        <form>

    </div>
</body>

    <script>
        $(document)
        .on ("click", "#delete_field", function () {
            $("#delete_field" ).parent().parent().remove();
        });
    </script>

    <script>
        $('#addIngredient').click(function(e){
            e.preventDefault();
            let new_field = `<div class = "recipe-group-1">
                                <div class = "recipe-key-1">
                                    <input style = "width: 140px" required type="text" name = "ingredients_key" id = "ingredients_key" placeholder = "Введите имя ингридиента"><button class = "danger" type = "button" id = "delete_field">X</button>
                                </div>
                                <div class = "container-recipe">
                                    <input required type="text" name = "ingredients_value" id = "ingredients_value" placeholder = "Введите вес ингридиента">
                                </div>
                            </div>`;
            $('#input_group').append(new_field);
        })
    </script>

    <script>
        $("#updateForm").submit(function(e){
            e.preventDefault();
            let id = window.location.pathname.split("/")[2]
            let name = $('#name').val();
            let cooking = $('#cooking').val();
            let nutritionalValue = $('#nutritionalValue').val();
            let description = $('#description').val();
            // let ingredients = $('#ingredients').val();
            let category_id = $('select[name=category_id]').val();

            let ingredients_keys = document.querySelectorAll("#ingredients_key");

            let ingredients_values = document.querySelectorAll("#ingredients_value");

            let arr_key = [], arr_val = [], ingredients = {};

            for(let ingredients_key of ingredients_keys){
                arr_key.push(ingredients_key.value)
            }

            for(let ingredients_value of ingredients_values){
                arr_val.push(ingredients_value.value)
            }

            for(let item in arr_key){
                ingredients[arr_key[item]] = arr_val[item];
            }
            
            $.ajax({
                url: `/api/recipes/${id}`,
                method: "PUT",
                data: {
                    name,
                    cooking,
                    nutritionalValue,
                    description,
                    ingredients,
                    category_id,
                },
                error: function(message) {
                    console.log(message);
                },
                success: function({data}) {
                    window.location.href = `/recipes/${data}`;
                }
            });
        })
    </script>

    <script>
        $('#addIngredient').click(function(e){
            e.preventDefault();
            let new_input_ingregient = "<input type='text' name = 'ingredients_value' id = 'ingredients_value'>";
            let new_key = "<input type = 'text' name = 'ingredients_key' id = 'ingredients_key'>"
            $('#new_key').append(new_key);
            $('#new_ingredient').append(new_input_ingregient);
        })
    </script>

    <script>
        $('#sendForm').submit(function(e){
            e.preventDefault();
            let id = window.location.pathname.split("/")[2]
            let fd = new FormData();
            let files = $('#file')[0].files[0];
            fd.append('photo',files);
            $.ajax({
                url: `/api/recipes/${id}`,
                method: "POST",
                data: fd,
                cache:false,
                contentType: false,
                processData: false,
                error: function(message) {
                    console.log(message);
                },
                success: function(data) {
                    console.log(data);
                    $("#image").attr("src",`/images/receipts/${data.data}`);
                }
            });
        })
    </script>

</html>