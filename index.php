<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="download.png" type="image/png" sizes="16x16">

    <script src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script type="text/javascript" src="../js/sweetalert2.js"></script>

</head>
<body>
<?php

require('authenticate/authenticate.php');

include "BDUtil.php";

$tipo = "f";
$uf = "";
$id = "";
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    if(isset($_GET['tipo'])) {
        $tipo = $_GET['tipo'];
        if($tipo == 'f') {
            $dado = BDUtil::GetPessoaById($_GET['id']);
        } else {
            $dado = BDUtil::GetEmpresaById($_GET['id']);
        }

        $uf = $dado['msg']['uf'];
    }
    
} else if(isset($_POST['logout'])) {
    session_unset();
}
?>

<div class="container  d-flex justify-content-center">
    <form class="mt-2 p-4 needs-validation form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
    <input type="hidden" name="id" value="<?= $id ?>" />
        <div class="form-group row">
            <div class="col-8 d-flex justify-content-end pr-4">
                <h1 class="d-inline">Cadastro</h1>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <button type="submit" value="logout" name="logout" class="btn btn-secondary" style="height: 38px;">logout</button>
            </div>
        </div>

        <fieldset class="form-group">
            <div class="row">
                <legend class="col-form-label col-2 pt-0"><strong>Categoria:</strong></legend>
                <div class="col-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="categoria" id="cpf" value="option1" 
                        <?php if(isset($_GET['id']) && $tipo == 'f') {
                                echo "disabled checked";
                              } else if(isset($_GET['id'])) {
                                echo "disabled";
                              } else if($tipo == 'f') {
                                echo "checked";
                              }?>>
                        <label class="form-check-label" for="cpf">
                            Pessoa Física
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="categoria" id="cnpj" value="option2"
                        <?php if(isset($_GET['id']) && $tipo == 'j') {
                                echo "disabled checked";
                              } else if(isset($_GET['id'])) {
                                echo "disabled";
                              } else if($tipo == 'j') {
                                echo "checked";
                              }?>>
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
                        <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome" 
                               value="<?php if($tipo == 'f' && isset($_GET['id'])) {
                                                echo $dado['msg']['nome'];
                                            } else if(isset($_GET['id'])) {
                                                echo $dado['msg']['razao_social'];
                                            }?>" required>
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
                        <input type="text" name="documento" class="form-control" id="documento" placeholder="CPF" 
                               value="<?php if($tipo == 'f' && isset($_GET['id'])) {
                                                echo $dado['msg']['cpf'];
                                            } else if(isset($_GET['id'])) {
                                                echo $dado['msg']['cnpj'];
                                            }?>"  required>
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
                            <input type="email" name="email" 
                                   class="form-control" id="email" placeholder="E-mail" 
                                   value="<?php if(isset($_GET['id'])) {
                                                    echo $dado['msg']['email'];
                                                } ?>" required>
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
                            <input type="text" name="telefone" 
                                   class="form-control" id="telefone" placeholder="Telefone" 
                                   value="<?php if(isset($_GET['id'])) {
                                                    echo $dado['msg']['telefone'];
                                                } ?>" required>
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
                            <input type="text" name="endereco" 
                                   class="form-control" id="endereco" placeholder="Logradouro" 
                                   value="<?php if(isset($_GET['id'])) {
                                                    echo $dado['msg']['logradouro'];
                                                } ?>" required>
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
                            <input type="text" name="numero" 
                                   class="form-control" id="numero" placeholder="Nº" 
                                   value="<?php if(isset($_GET['id'])) {
                                                    echo $dado['msg']['numero'];
                                                } ?>" required>
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
                            <input type="text" name="bairro" 
                                   class="form-control" id="bairro" placeholder="Bairro" 
                                   value="<?php if(isset($_GET['id'])) {
                                                    echo $dado['msg']['bairro'];
                                                } ?>" required>
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
                            <input type="text" name="cidade" 
                                   class="form-control" id="cidade" placeholder="Cidade" 
                                   value="<?php if(isset($_GET['id'])) {
                                                    echo $dado['msg']['cidade'];
                                                } ?>" required>
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
                            <select class="custom-select" name="uf" id="uf" 
                                value="<?php if(isset($_GET['id'])) {
                                                    echo $dado['msg']['uf'];
                                             } ?>" required>
                                <option value="" <?php echo $uf =="" ?'selected="selected"':'';?>></option>
                                <option value="AC" <?php echo $uf =="AC" ?'selected="selected"':'';?>>Acre</option>
                                <option value="AL" <?php echo $uf =="AL" ?'selected="selected"':'';?>>Alagoas</option>
                                <option value="AP" <?php echo $uf =="AP" ?'selected="selected"':'';?>>Amapá</option>
                                <option value="AM" <?php echo $uf =="AM" ?'selected="selected"':'';?>>Amazonas</option>
                                <option value="BA" <?php echo $uf =="BA" ?'selected="selected"':'';?>>Bahia</option>
                                <option value="CE" <?php echo $uf =="CE" ?'selected="selected"':'';?>>Ceará</option>
                                <option value="DF" <?php echo $uf =="DF" ?'selected="selected"':'';?>>Distrito Federal</option>
                                <option value="ES" <?php echo $uf =="ES" ?'selected="selected"':'';?>>Espírito Santo</option>
                                <option value="GO" <?php echo $uf =="GO" ?'selected="selected"':'';?>>Goiás</option>
                                <option value="MA" <?php echo $uf =="MA" ?'selected="selected"':'';?>>Maranhão</option>
                                <option value="MT" <?php echo $uf =="MT" ?'selected="selected"':'';?>>Mato Grosso</option>
                                <option value="MS" <?php echo $uf =="MS" ?'selected="selected"':'';?>>Mato Grosso do Sul</option>
                                <option value="MG" <?php echo $uf =="MG" ?'selected="selected"':'';?>>Minas Gerais</option>
                                <option value="PA" <?php echo $uf =="PA" ?'selected="selected"':'';?>>Pará</option>
                                <option value="PB" <?php echo $uf =="PB" ?'selected="selected"':'';?>>Paraíba</option>
                                <option value="PR" <?php echo $uf =="PR" ?'selected="selected"':'';?>>Paraná</option>
                                <option value="PE" <?php echo $uf =="PE" ?'selected="selected"':'';?>>Pernambuco</option>
                                <option value="PI" <?php echo $uf =="PI" ?'selected="selected"':'';?>>Piauí</option>
                                <option value="RJ" <?php echo $uf =="RJ" ?'selected="selected"':'';?>>Rio de Janeiro</option>
                                <option value="RN" <?php echo $uf =="RN" ?'selected="selected"':'';?>>Rio Grande do Norte</option>
                                <option value="RS" <?php echo $uf =="RS" ?'selected="selected"':'';?>>Rio Grande do Sul</option>
                                <option value="RO" <?php echo $uf =="RO" ?'selected="selected"':'';?>>Rondônia</option>
                                <option value="RR" <?php echo $uf =="RR" ?'selected="selected"':'';?>>Roraima</option>
                                <option value="SC" <?php echo $uf =="SC" ?'selected="selected"':'';?>>Santa Catarina</option>
                                <option value="SP" <?php echo $uf =="SP" ?'selected="selected"':'';?>>São Paulo</option>
                                <option value="SE" <?php echo $uf =="SE" ?'selected="selected"':'';?>>Sergipe</option>
                                <option value="TO" <?php echo $uf =="TO" ?'selected="selected"':'';?>>Tocantins</option>
                            </select>
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
                <?php if(isset($_GET['id'])) {
                        echo '<button type="submit" name="atualizar" class="btn btn-secondary">Atualizar</button>';    
                      } else {
                        echo '<button type="submit" name="salvar" class="btn btn-primary">Cadastrar</button>'; 
                      } ?>
            </div>
            <div class="col-sm-6 d-flex justify-content-start">
                <a class="btn btn-primary" href="list.php" role="button">Listar</a>
            </div>
        </div>
    </form>
</div>


<script type="text/javascript" src="js/index.js"></script>

<script type="text/javascript">
    jQuery(document).ready(function ($) {

        SetMascaras();
        mudarNomeCampos();
        cep();
        mascaraEmail();
        validarDocumento($("#documento"));
        validaNumero($("#numero"));
        validaTelefone($("#telefone"));
        logout($("button[name='logout']"));
        salvar($("button[name='salvar']"));
        select($("select"));
        update($("button[name='atualizar']"));
    });
</script>

</body>
</html>