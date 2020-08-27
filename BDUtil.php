<?php
/**
 * Created by PhpStorm.
 * User: AirgibDev
 * Date: 27/08/2020
 * Time: 14:15
 */


define('SERVERNAME', "localhost");
define('USERNAME', "root");
define('PASSWORD', "root");
define('DBNAME', "cadastro");


class BDUtil
{

    public static function OpenConnection()
    {
        $conn = new PDO("mysql:host=" . SERVERNAME . ";dbname=" . DBNAME, USERNAME, PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;

    }

    public static function SetPessoas($nome , $documento, $email, $celular, $endereco, $numero, $bairro, $cidade, $uf)
    {

        $conn = self::OpenConnection();

        try {

            $sql = "INSERT INTO empresa (razao_social, cnpj, email, telefone, logradouro, numero, bairro, cidade, uf)
            VALUES ('$nome' , '$documento', '$email', '$celular', '$endereco', '$numero',' $bairro', '$cidade', '$uf')";

            $conn->beginTransaction();
            $resultado = $conn->query($sql);

            if ($resultado->rowCount() == 0) {
                $conn->rollBack();
                return false;
            } else {
                $conn->commit();
                $idpessoa = $conn->lastInsertId();
                return $idpessoa;
            }

        } catch (Exception $e) {

            $conn->rollBack();
            return $e->getTraceAsString();
        }

    }

    public static function GetPessoas()
    {

        $conn = self::OpenConnection();

        try {

            $sql = "SELECT * FROM pessoa;";

            $resultado = $conn->query($sql);

            if ($resultado->rowCount() == 0) {

                $resp['erro'] = true;
                $resp['msg'] = 'Nenhum resultado';

            } else {


                $resp['erro'] = false;
                $resp['msg'] = $resultado->fetchAll(PDO::FETCH_ASSOC);

            }

        } catch (Exception $e) {

            $resp['erro'] = true;
            $resp['msg'] = $e->getTraceAsString();

          
        } finally {
            return $resp;
        }

    }

}

