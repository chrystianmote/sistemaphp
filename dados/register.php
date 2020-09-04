<?php 
    include "../BDUtil.php";

    if(isset($_POST['registrar'])) {
        if(isset($_POST['username']) && isset($_POST['password'])) {
           $id = BDUtil::SetUser($_POST['username'],$_POST['password']);
           if($id > 0) {
                $resp['erro'] = false;
                $resp['msg'] = 'Usuário cadastrado com sucesso!';
                session_start();
                $_SESSION["authenticated"] = 'true';
           } else if ($id == -1) {
                $resp['erro'] = true;
                $resp['msg'] = 'O username já esta sendo utilizado!';
           } else {
                $resp['erro'] = true;
                $resp['msg'] = 'Não foi possível cadastrar o usuário!';
           }
        }
    }
    echo json_encode(isset($resp) ? $resp : []); 
?>