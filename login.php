<?php
require_once 'header.php';

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="common/assets/vendor/bootstrap/css/bootstrap.min.css"/>
        <!-- theme CSS -->
        <link rel="stylesheet" href="backend/assets/libs/css/style.css"/>
        <!-- Bootstrap bundle js -->
        <script src="common/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
        <!-- jquery 3.6.0 -->
        <script src="common/assets/vendor/jquery/jquery-3.6.0.min.js"></script>
        <title>Вписване</title>
    </head>
    <body class="registration">
        <div class="row m-0 h-100">
            <div class="col p-0 text-center d-flex justify-content-center align-items-center m-display-none-image">
                <img src="backend/assets/images/login.svg" class="w-100">
            </div>
            <div class="col p-0 bg-custom d-flex justify-content-center align-items-center flex-column w-100">
                <form class="w-75" action="#">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="username" autocomplete="off"
                               required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="password" autocomplete="off"
                               required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Keep me logged in
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="btn-login" class="btn btn-custom btn-lg btn-block mt-3">Вход</button>
                    <p id="success" style="display: none;color:green;font-weight: bold;margin-top: 10px;"></p>
                    <p id="error" style="display: none;color:red;font-weight: bold;margin-top: 10px;"></p>
                    <a href="<?php echo URLBASE?>/registration.php" ><button type="button" id="btn-reg" class="btn btn-custom btn-lg btn-block mt-3">Регистрация</button></a>
                </form>
            </div>
        </div>
    </body>
</html>
<script>

$('#btn-login').unbind().bind('click', function(e){
    e.preventDefault();
    var username = $("#username"). val();
    var password = $("#password"). val();

    if(username != "" && password != ""){
        $.ajax({
            url: "backend/includes/user/login.php",
                type: "POST",
                data: {
                    username: username,
                    password: password,
                },
                cache: false,
                success: function(dataResult){
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode == 200){
                        window.location = "./index.php";
                    } else if (dataResult.statusCode == 201){
                        $('#error').html('Паролата не съвпада');
                    } else if(dataResult.statusCode == 202){
                        $('#error').html('Няма такъв потребител');
                    }
                }
        });
    } else {
        echo('Моля, въведете вашите данни');
    }
});

</script>
<style>
    .navbar{
        display: none;
    }
</style>