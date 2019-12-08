<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo asset('css/receipt_create.css')?>" type="text/css"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link href="http://fonts.fontstorage.com/import/poppins.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&amp;subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:700" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Создать рецепт</title>
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


    <!-- <div class = "container-group">
        <div class = "image_header">
            <div class = "image">
                <input style = "width: 300px" type="image" width = "400" height = "230" id = "image" name="image"
                    src = "" width="50">
            </div>
        </div>

        <div class = "image-group">
            <div class = "image-group1">
                <form id = "sendFormPhoto">
                    <div style = "float: right">
                        <input type="file" name="pic" id = "file" accept="image/*">
                    </div>
                    <div style = "float: left">
                        <input style = "width: 100px;" type="submit" value = "Загрузить">
                    </div>
                </form>
            </div>
        </div>
    </div> -->
    <div id = "error_message" hidden class="alert alert-danger">
        <a id = "close" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        <strong>Внимание! </strong>Выберите категорию!
    </div>

    <form id = "sendForm">
        <div style = "margin-top: 90px" class ="select_div">
            <select required class = "custom_select" name="category_id" id = "category_id">
                <option value = "default" disabled selected>Выберите свой вариант</option>
                @foreach ($categories as $key => $category)
                    <option value="{{$category->id}}">
                            {{$category->name}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class = "button_field">
            <div>
                <button id = "addIngredient" class = "create_button" type = "button">Добавить ингредиент</button>
            </div>
           <div>
                <button class = "create_button" type = "submit">Создать рецепт</button>
           </div>
        </div>

        <div class = "input_group" id = "input_group">
            <div class = "input_field">
                <input required type="text" name = "name" id = "name" placeholder = "Введите имя">
            </div>
            
            <div class = "input_field">
                <input required type="text" name = "cooking" id = "cooking" placeholder = "Введите время приготовления">
            </div>

            <div class = "input_field">
                <input required type="text" name = "nutritionalValue" id = "nutritionalValue" placeholder = "Введите пищевую ценность порции">
            </div>
            
            <div class = "input_field">
                <textarea rows = "10" required type="text" name = "description" id = "description" placeholder = "Введите описание"></textarea>
            </div>

            <div style = "margin-top: 10px">
                    <p style = "font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; text-align: center;">Ингредиенты</p>
            </div>

            <div class = "input_field">
                <input required type="text" name = "ingredients_key" id = "ingredients_key" placeholder = "Введите имя ингридиента">
            </div>
            <div class = "input_field">
                <input required type="text" name = "ingredients_value" id = "ingredients_value" placeholder = "Введите вес ингридиента">
            </div>

            
        </div>
                <!-- <input required type="text" name = "ingredients_key" id = "ingredients_key" placeholder = "Введите имя ингридиента">
        <input required type="text" name = "ingredients_value" id = "ingredients_value" placeholder = "Введите вес ингридиента"> -->

        <!-- <button type = "submit">Создать</button> -->

        <input id = "user" type="text" hidden value = "{{Session::get('user')->id}}">

    </form>

</body>
    <!-- <script>
        $('#sendFormPhoto').submit(function(e){
            console.log("here");
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
    </script> -->

    <script>
        $('#close').click(function(e){
            $('#error_message').remove();
        });
        // setTimeout(() => {
        //     $('#error_message').remove();
        // }, 3000);
    </script>

    <script>
        $(document)
        .on ("click", "#delete_field", function () {
            $("#delete_field" ).parent().parent().remove();
        });
    </script>

    <script>
        $('#addIngredient').click(function(e){
            e.preventDefault();
            let new_field = `<div><div class = "input_field">
                                <input style = "margin-left: 33px" required type="text" name = "ingredients_key" id = "ingredients_key" placeholder = "Введите имя ингридиента"><button class = "danger" type = "button" id = "delete_field">X</button>
                            </div>
                            <div class = "input_field">
                                <input required type="text" name = "ingredients_value" id = "ingredients_value" placeholder = "Введите вес ингридиента">
                            </div></div>`;
            $('#input_group').append(new_field);
        })
    </script>

    <script>
        $("#sendForm").submit(function(e){
            e.preventDefault();
            const user_id = +$('#user').val();
            let name = $('#name').val();
            let cooking = $('#cooking').val();
            let nutritionalValue = $('#nutritionalValue').val();
            let description = $('#description').val();
            let category_id = $('select[name=category_id]').val();
            if(!category_id){
                $('#error_message').removeAttr('hidden');
            }
            else{
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
                    url: '/api/recipes',
                    method: "POST",
                    data: {
                        name,
                        cooking,
                        nutritionalValue,
                        description,
                        ingredients,
                        category_id,
                        user_id
                    },
                    error: function(message) {
                        console.log(message);
                    },
                    success: function({data}) {
                        window.location.href = `/recipes/${data}`;
                    }
                });
            }
        });
    </script>
</html>