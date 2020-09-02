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

    public static function DeleteEmpresa($id) {
        $conn = self::OpenConnection();
        var_dump($id);
        try {
            $sql = "DELETE FROM empresa WHERE id = $id";

            $resultado = $conn->query($sql);

            if ($resultado->rowCount() == 0) {
                return false;
            } else {
                return true;
            }

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function DeletePessoa($id) {
        $conn = self::OpenConnection();

        try {
            $sql = "DELETE FROM pessoa WHERE id = $id";

            $resultado = $conn->query($sql);

            if ($resultado->rowCount() == 0) {
                return false;
            } else {
                return true;
            }

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function SetEmpresa($nome , $documento, $email, $celular, $endereco, $numero = 0 , $bairro, $cidade, $uf)
    {

        $conn = self::OpenConnection();

        try {

            $sql = "INSERT INTO empresa (razao_social, cnpj, email, telefone, logradouro, numero, bairro, cidade, uf)
            VALUES ('$nome' , '$documento', '$email', '$celular', '$endereco', $numero, '$bairro', '$cidade', '$uf')";

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
            VALUES ('$nome' , '$documento', '$email', '$celular', '$endereco', $numero, '$bairro', '$cidade', '$uf')";

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

    public static function SetUser($username , $password)
    {

        $conn = self::OpenConnection();
        
        $password = password_hash($password, PASSWORD_BCRYPT);
        
        $resp = self::GetUserByUsername($username);
        if(!$resp['erro']) {
            return -1;
        }
        try {
            $sql = "INSERT INTO user (username, password)
            VALUES ('$username' , '$password')";
            
            $resultado = $conn->query($sql);

            if ($resultado->rowCount() == 0) {
                
                return false;
            } else {

                $iduser= $conn->lastInsertId();
                return $iduser;
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

    public static function GetUserByUsername($username)
    {

        $conn = self::OpenConnection();

        try {

            $sql = "SELECT * FROM user WHERE username = '$username';";
            $resultado = $conn->query($sql);

            if ($resultado->rowCount() == 0) {

                $resp['erro'] = true;
                $resp['msg'] = 'Usuário não encontrado!';

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

    public static function Login($username, $password)
    {

        $user = self::GetUserByUsername($username);
        if($user['erro']) {
            return $user;
        } else {
            if($user['msg']['password'] == password_hash($password, PASSWORD_BCRYPT)) {
                $user['msg']['password'] = "";
                return $user;
            } else {
                $user['erro'] = true;
                $user['msg'] = 'Senha incorreta!';
                return $user;
            }
        }
    }

    public static function UpdateEmpresa($id, $razao_social , $documento, $email, $celular, $endereco, $numero = 0 , $bairro, $cidade, $uf)
    {

        $conn = self::OpenConnection();

        try {

            $sql = "UPDATE empresa 
                    SET razao_social = '$razao_social', cnpj = '$documento', email = '$email', telefone = '$celular', logradouro = '$endereco', numero = $numero, bairro = '$bairro', cidade = '$cidade', uf = '$uf'
                    WHERE id = $id ";
            $resultado = $conn->query($sql);

            if ($resultado->rowCount() == 0) {
                return false;
            } else {
                return $id;
            }

        } catch (Exception $e) {
            return $e->getMessage();
        }

    }
    public static function UpdatePessoa($id, $nome , $documento, $email, $celular, $endereco, $numero = 0 , $bairro, $cidade, $uf)
    {

        $conn = self::OpenConnection();

        try {

            $sql = "UPDATE pessoa 
                    SET nome = '$nome', cpf = '$documento', email = '$email', telefone = '$celular', logradouro = '$endereco', numero = $numero, bairro = '$bairro', cidade = '$cidade', uf = '$uf'
                    WHERE id = $id ";
            $resultado = $conn->query($sql);

            if ($resultado->rowCount() == 0) {
                return false;
            } else {
                return $id;
            }

        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

}

