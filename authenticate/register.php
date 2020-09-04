<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="download.png" type="image/png" sizes="16x16">

    <script src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/sweetalert2.js"></script>
</head>
<body>
    <?php 
        include "../BDUtil.php";
        
        if(isset($_POST['registrar'])) {
            if(isset($_POST['username']) && isset($_POST['password'])) {
               $id = BDUtil::SetUser($_POST['username'],$_POST['password']);
               if($id > 0) {
                    echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Usuário cadastrado com sucesso!'
                            });
                         </script>";
               } else if ($id == -1) {
                    echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'O username já esta sendo utilizado!'
                            });
                         </script>";
               } else {
                    echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Não foi possível cadastrar o usuário!'
                            });
                         </script>";
               }
            }
        }
    ?>
    <div class="container d-flex justify-content-center">
        <form class="mt-2 p-4 needs-validation form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
            <div class="form-group row">
                <div class="col-12">
                    <h1>Registrar</h1>
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
                    <button type="submit" name="registrar" class="btn btn-primary">Registrar</button>
                    <a class="btn btn-primary ml-4" href="login.php" role="button">Login</a>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="../js/register.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            registrar($("button"));
        });
    </script>
</body>
</html>