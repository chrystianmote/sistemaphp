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

    public static function SetEmpresa($nome , $documento, $email, $celular, $endereco, $numero = 0 , $bairro, $cidade, $uf)
    {

        $conn = self::OpenConnection();

        try {

            $sql = "INSERT INTO empresa (razao_social, cnpj, email, telefone, logradouro, numero, bairro, cidade, uf)
            VALUES ('$nome' , '$documento', '$email', '$celular', '$endereco', $numero,' $bairro', '$cidade', '$uf')";

            $resultado = $conn->query($sql);

            if ($resultado->rowCount() == 0) {
                return false;
            } else {

                $idpessoa = $conn->lastInsertId();
                return $idpessoa;
            }

        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

    public static function SetPessoa($nome , $documento, $email, $celular, $endereco, $numero = 0 , $bairro, $cidade, $uf)
    {

        $conn = self::OpenConnection();

        try {

            $sql = "INSERT INTO pessoa (nome, cpf, email, telefone, logradouro, numero, bairro, cidade, uf)
            VALUES ('$nome' , '$documento', '$email', '$celular', '$endereco', $numero,' $bairro', '$cidade', '$uf')";

            $resultado = $conn->query($sql);

            if ($resultado->rowCount() == 0) {
                return false;
            } else {

                $idpessoa = $conn->lastInsertId();
                return $idpessoa;
            }

        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

    public static function GetEmpresaById($id)
    {

        $conn = self::OpenConnection();

        try {

            $sql = "SELECT * FROM empresa WHERE id = $id;";

            $resultado = $conn->query($sql);

            if ($resultado->rowCount() == 0) {

                $resp['erro'] = true;
                $resp['msg'] = 'Não foi encontrado uma empresa com esse id';

            } else {


                $resp['erro'] = false;
                $resp['msg'] = $resultado->fetch(PDO::FETCH_ASSOC);

            }

        } catch (Exception $e) {

            $resp['erro'] = true;
            $resp['msg'] = $e->getMessage();

          
        } finally {
            return $resp;
        }

    }


    public static function GetPessoaById($id)
    {

        $conn = self::OpenConnection();

        try {

            $sql = "SELECT * FROM pessoa WHERE id = $id;";

            $resultado = $conn->query($sql);

            if ($resultado->rowCount() == 0) {

                $resp['erro'] = true;
                $resp['msg'] = 'Não foi encontrado uma pessoa com esse id';

            } else {


                $resp['erro'] = false;
                $resp['msg'] = $resultado->fetch(PDO::FETCH_ASSOC);

            }

        } catch (Exception $e) {

            $resp['erro'] = true;
            $resp['msg'] = $e->getMessage();

          
        } finally {
            return $resp;
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
            $resp['msg'] = $e->getMessage();

          
        } finally {
            return $resp;
        }

    }

    public static function GetEmpresas()
    {

        $conn = self::OpenConnection();

        try {

            $sql = "SELECT * FROM empresa;";

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
            $resp['msg'] = $e->getMessage();

          
        } finally {
            return $resp;
        }

    }

}

