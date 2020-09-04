<?php 

    require('../authenticate/authenticate.php');

    include "../BDUtil.php";

    if (isset($_POST['atualizar'])) {

        $nome = $_POST['nome'];
        $documento = $_POST['documento'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'] ? $_POST['telefone'] : "";
        $endereco = $_POST['endereco'] ? $_POST['endereco'] : "";
        $numero = $_POST['numero'] != "S/D" ? $_POST['numero'] : 0;
        $bairro = $_POST['bairro'] ? $_POST['bairro'] : "";
        $cidade = $_POST['cidade'] ? $_POST['cidade'] : "";
        $uf = $_POST['uf'] ? $_POST['uf'] : "";

        try {
            if (strlen($documento) == 18) {
                $id = BDUtil::UpdateEmpresa($_POST['id'], $nome, $documento, $email, $telefone, $endereco, $numero, $bairro, $cidade, $uf);
                if ($id > 0) {
                    $resp['erro'] = false;
                    $resp['msg'] = "Os dados da empresa $nome foram atualizada com sucesso!";
                } else {
                    $resp['erro'] = true;
                    $resp['msg'] = "Não foi possível atualizar os dados da empresa $nome!";
                }
            } else if (strlen($documento) == 14) {
                $id = BDUtil::UpdatePessoa($_POST['id'], $nome, $documento, $email, $telefone, $endereco, $numero, $bairro, $cidade, $uf);
                
                if ($id > 0) {
                    $resp['erro'] = false;
                    $resp['msg'] = "Os dados da pessoa $nome foram atualizada com sucesso!";
                } else {
                    $resp['erro'] = true;
                    $resp['msg'] = "Não foi possível atualizar os dados da pessoa $nome!";
                }
                
            }
        } catch (PDOException $e) {
            $resp['erro'] = true;
            $resp['msg'] =  $e->getMessage();
        }
    }
    echo json_encode(isset($resp) ? $resp : []);
?>