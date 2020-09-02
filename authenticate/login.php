<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php

include "../BDUtil.php";

$username = null;
$password = null;

if (isset($_POST['login'])) {

    if(!empty($_POST["username"]) && !empty($_POST["password"])) {
        
        $resp = BDUtil::Login($_POST["username"], $_POST["password"]);
        if(!$resp['erro']) {
            echo '<script>
                    alert("Login efetuado com sucesso!");
                </script>';
            // session_start();
            // $_SESSION["authenticated"] = 'true';
            // header('Location: index.php');
        }
        else {
            echo "<script>
                    alert(\"{$resp['msg']}\");
                </script";   

            // header('Location: login.php');
        }  
    } 
} 
?>    
<div class="container d-flex justify-content-center">
        <form class="mt-2 p-4 needs-validation form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
            <div class="form-group row">
                <div class="col-12">
                    <h1>Login</h1>
                </div>
            </div>
            <div class="form-group row d-flex justify-content-center">
                <label for="username" class="col-2 col-form-label">Username:</label>
                <div class="col-6 pl-2">
                    <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                    <div class="invalid-feedback">
                        Campo obrigatório
                    </div>
                </div> 
            </div>
            <div class="form-group row d-flex justify-content-center">
                <label for="password" class="col-2 col-form-label">Senha:</label>
                <div class="col-6 pl-2">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Senha" required>
                    <div class="invalid-feedback">
                        Campo obrigatório
                    </div>
                </div> 
            </div>
            <div class="form-group row">
                <div class="col-12 d-flex justify-content-center">
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                    <a class="btn btn-primary ml-4" href="register.php" role="button">Novo Usuário</a>
                </div>
            </div>
        </form>
    </div>
    
    <script type="text/javascript">

    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
            });
        }, false);
    })();
</script>

</body>
</html>