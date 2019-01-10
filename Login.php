<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login View</title>

    <script src="Script/alertify.js"></script>

    <link href="Style/alertify.rtl.css" rel="stylesheet" type="text/css" />
    <link href="Style/default.rtl.css" rel="stylesheet" type="text/css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js" ></script>
    <link rel="stylesheet" type="text/css" href="Style/Login.css">
    <style>
        body {background:url(Images/b1.jpg);
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            min-height: 100vh;
        }
    </style>
    <script>

        $( document ).ready(function() {



            var registerResponse=<?php

            if (isset($_GET['register'])){

                printf($_GET['register']);
            }else
                echo "'login' "

            ?>;
            if(registerResponse==1)
                alertify.error("Kaydetmek istediğiniz bilgiler ile kayıtınız vardır.");

            if (registerResponse==0)
                alertify.success("Kayıt Başarılı. Giriş Yapınız.")

            if (registerResponse==2)
                alertify.error("Giriş bilgilerinizi kontrol ediniz.")

        });

     function GetRegisterModal() {
         $('#registerModal').modal('show');
     }

    </script>

</head>
<body>


<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Giriş Yap</h5>
                    <form name="loginForm"  action="LoginController.php" method="post" class="form-signin">
                        <div class="form-label-group">
                            <input type="email" name="inputEmail" id="inputEmail" class="form-control" placeholder="Email adresi" required autofocus>
                            <label for="inputEmail">Email adresi</label>
                        </div>

                        <div class="form-label-group">
                            <input type="password"  name="inputPassword" id="inputPassword" class="form-control" placeholder="Şifre" required>
                            <label for="inputPassword">Şifre</label>
                        </div>


                            <input type="button" value="Kayıt Ol" name="loginForm" onclick="GetRegisterModal()" class="btn btn-lg btn-primary btn-block text-uppercase" />


                        <button name="loginForm" class="btn btn-lg btn-success btn-block text-uppercase" type="submit">Giriş Yap</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yeni Kayıt</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="registerForm" action="LoginController.php" method="post">
                        <div class="form-group">
                            <label for="UserName" class="col-form-label">Kullanıcı Adı:</label>
                            <input name="UserName" type="text" class="form-control" id="UserName">
                        </div>
                        <div class="form-group">
                            <label for="UserMail" class="col-form-label">E-Mail:</label>
                            <input name="UserMail" type="email" class="form-control" id="UserMail">
                        </div>
                        <div class="form-group">
                            <label for="UserPassword" class="col-form-label">Şifre:</label>
                            <input name="UserPassword" type="password" class="form-control" id="UserPassword">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                            <button name="registerForm" type="submit" class="btn btn-primary">Kayıt Ol</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="container">


</div>






</body>
</html>
