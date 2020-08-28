<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">

    <script src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/jquery.mask.js"></script>
    
    <script type="text/javascript" src="/js/index.js"></script>
</head>
<body>
<?php

include "BDUtil.php";

if (isset($_POST['salvar'])) {

    $nome = $_POST['nome'];
    $documento = $_POST['documento'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'] ? $_POST['telefone'] : "";
    $endereco = $_POST['endereco'] ? $_POST['endereco'] : "";
    $numero = !empty($_POST['numero']) ? $_POST['numero'] : 0;
    $bairro = $_POST['bairro'] ? $_POST['bairro'] : "";
    $cidade = $_POST['cidade'] ? $_POST['cidade'] : "";
    $uf = $_POST['uf'] ? $_POST['uf'] : "";

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "cadastro";

    try {
        if (strlen($documento) == 18){
            $id = BDUtil::SetEmpresa($nome , $documento, $email, $telefone, $endereco, $numero, $bairro, $cidade, $uf);
            if($id > 0){
                echo "
                    <script type=\"text/javascript\">
                    alert('Nova Empresa cadastrada');
                    </script>
                ";
            }
            else{
                echo "
                    <script type=\"text/javascript\">
                    alert('Não foi possível cadastrar a nova empresa');
                    </script>
                ";
            }
        } else if(strlen($documento) == 14) {
            $id = BDUtil::SetPessoa($nome , $documento, $email, $telefone, $endereco, $numero, $bairro, $cidade, $uf);
            if($id > 0){
                echo "
                <script type=\"text/javascript\">
                alert('Nova Pessoa cadastrada');
                </script>
            ";
            }
            else{
                echo "
                <script type=\"text/javascript\">
                alert('Não foi possível cadastrada a nova Pessoa');
                </script>
            ";
            }
        } else {
            echo "
            <script type=\"text/javascript\">
            alert('Documento invalido');
            </script>
            ";
        }
        $conn = null;

    } catch (PDOException $e) {
        echo "<br>" . $e->getMessage();
    }    
}
?>

<div class="container">
        <form class="mt-2 p-4" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group row">
                <div class="col-12">
                    <h1>Cadastro</h1>
                </div>
            </div>

            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-2 pt-0"><strong>Categoria:</strong></legend>
                    <div class="col-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="categoria" id="cpf" value="option1" checked>
                            <label class="form-check-label" for="cpf">
                                Pessoa Física
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="categoria" id="cnpj" value="option2">
                            <label class="form-check-label" for="cnpj">
                                Pessoa Jurídica
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <div class="form-group row">
                <div class="col-6">
                    <div class="row">
                        <label for="nome" class="col-4 col-form-label lbname">Nome:</label>
                        <div class="col-8 pl-2">
                            <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <label for="documento" class="col-2 col-form-label lbdocumento">CPF:</label>
                        <div class="col-10 pl-2">
                            <input type="text" name="documento" class="form-control" id="documento" placeholder="CPF">
                        </div>
                    </div>    
                </div>
            </div>
            
            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-12 pt-0"><strong>Contato:</strong></legend>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <label for="email" class="col-2 col-form-label">Gmail:</label>
                            <div class="col-10 pl-2">
                                <input type="email" name="email" class="form-control" id="email" placeholder="E-mail">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <label for="telefone" class="col-2 col-form-label">Telefone:</label>
                            <div class="col-10 pl-2">
                                <input type="text" name="telefone" class="form-control" id="telefone" placeholder="Telefone">
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-12 pt-0"><strong>Endereço:</strong></legend>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <div class="row">
                            <label for="cep" class="col-2 col-form-label">CEP:</label>
                            <div class="col-10 pl-2">
                                <input type="text" name="cep" class="form-control" id="cep" placeholder="CEP">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <label for="endereco" class="col-3 col-form-label">Logradouro:</label>
                            <div class="col-9 pl-2">
                                <input type="text" name="endereco" class="form-control" id="endereco" placeholder="Logradouro">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <div class="row">
                            <label for="numero" class="col-2 col-form-label">Número:</label>
                            <div class="col-10 pl-2">
                                <input type="text" name="numero" class="form-control" id="numero" placeholder="Nº">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <label for="bairro" class="col-2 col-form-label">Bairro:</label>
                            <div class="col-10 pl-2">
                                <input type="text" name="bairro" class="form-control" id="bairro" placeholder="Bairro">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <label for="cidade" class="col-2 col-form-label">Cidade:</label>
                            <div class="col-10 pl-2">
                                <input type="text" name="cidade" class="form-control" id="cidade" placeholder="Cidade">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <label for="uf" class="col-2 col-form-label">UF:</label>
                            <div class="col-10 pl-2">
                                <input type="text" name="uf" class="form-control" id="uf" placeholder="UF">
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>

            <div class="form-group row">
                <div class="col-sm-6 d-flex justify-content-end">
                    <button type="submit" name="salvar" class="btn btn-primary">Cadastrar</button>
                </div>
                <div class="col-sm-6 d-flex justify-content-start">
                    <a class="btn btn-primary" href="list.php" role="button">Listar</a>
                </div>
            </div>
        </form>       
    </div>
</body>
</html>