<?php 
    require('../authenticate/authenticate.php');

    include "../BDUtil.php";

    if(isset($_POST['deleteItem']) and is_numeric($_POST['deleteItem'])) {
        $id = $_POST['deleteItem'];
        if(isset($_POST['tipo']) && $_POST['tipo'] == 'f') {
        $delete = BDUtil::DeletePessoa($id);
        if ($delete) {
            $resp['erro'] = false;
            $resp['msg'] = 'Os dados dessa pessoa deletada com sucesso!';
            } else {
                $resp['erro'] = true;
                $resp['msg'] = 'Não foi possível deletar os dados dessa pessoa!';
            }
        } else if(isset($_POST['tipo']) && $_POST['tipo'] == 'j') {
            $delete = BDUtil::DeleteEmpresa($id);
        if ($delete) {
                $resp['erro'] = false;
                $resp['msg'] = 'Os dados dessa empresa foram deletados com sucesso!';
            } else {
                $resp['erro'] = true;
                $resp['msg'] = 'Não foi possível deletar os dados dessa empresa!';
            }
        }
    }
    echo json_encode(isset($resp) ? $resp : []); 
?>