<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.mask.js"></script>

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
    $numero = $_POST['numero'] != "S/D" ? $_POST['numero'] : 0;
    $bairro = $_POST['bairro'] ? $_POST['bairro'] : "";
    $cidade = $_POST['cidade'] ? $_POST['cidade'] : "";
    $uf = $_POST['uf'] ? $_POST['uf'] : "";

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "cadastro";

    try {
        if (strlen($documento) == 18) {
            $id = BDUtil::SetEmpresa($nome, $documento, $email, $telefone, $endereco, $numero, $bairro, $cidade, $uf);
            if ($id > 0) {
                echo "
                    <script type=\"text/javascript\">
                    alert('Nova Empresa cadastrada');
                    </script>
                ";
            } else {
                echo "
                    <script type=\"text/javascript\">
                    alert('Não foi possível cadastrar a nova empresa');
                    </script>
                ";
            }
        } else if (strlen($documento) == 14) {
            $id = BDUtil::SetPessoa($nome, $documento, $email, $telefone, $endereco, $numero, $bairro, $cidade, $uf);
            if ($id > 0) {
                echo "
                <script type=\"text/javascript\">
                alert('Nova Pessoa cadastrada');
                </script>
            ";
            } else {
                echo "
                <script type=\"text/javascript\">
                alert('Não foi possível cadastrada a nova Pessoa');
                </script>
            ";
            }
        }
        $conn = null;

    } catch (PDOException $e) {
        echo "<br>" . $e->getMessage();
    }

    $_POST['salvar'] = null;
}
?>

<div class="container">
    <form class="mt-2 p-4 needs-validation" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
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
                        <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome" required>
                        <div class="invalid-feedback">
                            Campo obrigatório
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <label for="documento" class="col-2 col-form-label lbdocumento">CPF:</label>
                    <div class="col-10 pl-2">
                        <input type="text" name="documento" class="form-control" id="documento" placeholder="CPF" required>
                        <div class="invalid-feedback">
                            Campo obrigatório
                        </div>
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
                            <input type="email" name="email" class="form-control" id="email" placeholder="E-mail" required>
                            <div class="invalid-feedback">
                                Campo obrigatório
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <label for="telefone" class="col-2 col-form-label">Telefone:</label>
                        <div class="col-10 pl-2">
                            <input type="text" name="telefone" class="form-control" id="telefone"
                                   placeholder="Telefone" required>
                            <div class="invalid-feedback">
                                Campo obrigatório
                            </div>       
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
                            <input type="text" name="endereco" class="form-control" id="endereco"
                                   placeholder="Logradouro" required>
                            <div class="invalid-feedback">
                                Campo obrigatório
                            </div>       
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-6">
                    <div class="row">
                        <label for="numero" class="col-2 col-form-label">Número:</label>
                        <div class="col-10 pl-2">
                            <input type="text" name="numero" class="form-control" id="numero" placeholder="Nº" required>
                            <div class="invalid-feedback">
                                Campo obrigatório.<br>
                                Obs.: Colocar "S/D" caso não possua Nº.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <label for="bairro" class="col-2 col-form-label">Bairro:</label>
                        <div class="col-10 pl-2">
                            <input type="text" name="bairro" class="form-control" id="bairro" placeholder="Bairro" required>
                            <div class="invalid-feedback">
                                Campo obrigatório
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <label for="cidade" class="col-2 col-form-label">Cidade:</label>
                        <div class="col-10 pl-2">
                            <input type="text" name="cidade" class="form-control" id="cidade" placeholder="Cidade" required>
                            <div class="invalid-feedback">
                                Campo obrigatório
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <label for="uf" class="col-2 col-form-label">UF:</label>
                        <div class="col-10 pl-2">
                            <select class="custom-select" name="uf" id="uf" required>
                                <option value="" selected></option>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                            </select>
                            <!-- <input type="text" name="uf" class="form-control" id="uf" placeholder="UF" required> -->
                            <div class="invalid-feedback">
                                Campo obrigatório
                            </div>
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


<script type="text/javascript" src="js/index.js"></script>


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
<script type="text/javascript">
    jQuery(document).ready(function ($) {

        SetMascaras();
        mudarNomeCampos();
        cep();
        mascaraEmail();
        validarDocumento($("#documento"));
        validaNumero($("#numero"));
        validaTelefone($("#telefone"));

    });
</script>

</body>
</html>