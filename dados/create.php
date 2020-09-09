<?php 
    require('../authenticate/authenticate.php');

    include "../BDUtil.php";

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
        
        try {
            if (strlen($documento) == 18) {
                $id = BDUtil::SetEmpresa($nome, $documento, $email, $telefone, $endereco, $numero, $bairro, $cidade, $uf);
                if ($id > 0) {
                    $resp['erro'] = false;
                    $resp['msg'] = 'Nova Empresa cadastrada com sucesso!';
                } else {
                    $resp['erro'] = true;
                    if(strlen($numero) > 4) {
                        $resp['msg'] = "O campo Número só pode armazernar até 4 algoritmos!";
                    } else {
                        $resp['msg'] = 'Não foi possível cadastrar a nova empresa!';
                    }
                }
            } else if (strlen($documento) == 14) {
                $id = BDUtil::SetPessoa($nome, $documento, $email, $telefone, $endereco, $numero, $bairro, $cidade, $uf);
                if ($id > 0) {
                    $resp['erro'] = false;
                    $resp['msg'] = 'Nova Pessoa cadastrada com sucesso!';
                } else {
                    $resp['erro'] = true;
                    if(strlen($numero) > 4) {
                        $resp['msg'] = "O campo Número só pode armazernar até 4 algoritmos!";
                    } else {
                        $resp['msg'] = 'Não foi possível cadastrada a nova Pessoa!';
                    }
                }
            }
        } catch (PDOException $e) {
            $resp['erro'] = true;
            $resp['msg'] = $e->getMessage();
        }
    }
    echo json_encode(isset($resp) ? $resp : []); 
?>