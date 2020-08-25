<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro</title>
</head>
<body>
<?php
if(isset($_POST['salvar'])) 
{ 

    $nome = $_POST['nome'];
    $documento = $_POST['documento'];
    $email = $_POST['email'];
    $celular = $_POST['celular'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "cadastro";     

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(strlen($documento) > 11) {
            $sql = "INSERT INTO empresa (razao_social, cnpj, email, telefone, logradouro, numero, bairro, cidade, uf)
            VALUES ('$nome' , '$documento', '$email', '$celular', '$endereco', '$numero',' $bairro', '$cidade', '$uf')";
            echo "
                <script type=\"text/javascript\">
                alert('Nova Empresa cadastrada');
                </script>
            ";
        } else {
            $sql = "INSERT INTO pessoa (nome, cpf, email, telefone, logradouro, numero, bairro, cidade, uf)
            VALUES ('$nome' , '$documento', '$email', '$celular', '$endereco', '$numero',' $bairro', '$cidade', '$uf')";
            echo "
            <script type=\"text/javascript\">
            alert('Nova Pessoa cadastrada');
            </script>
        ";
        }
        // use exec() because no results are returned
        $conn->exec($sql);
        
      } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
      }
      
      $conn = null;
}
?>
    <div class="page">
        <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <h1>Cadastro</h1>
            <div class="row">
                <div class="group">
                    <label for="nome">Nome/Razão Social: </label>
                    <input type="text" name="nome" placeholder="Nome/Razão Social">
                </div>
                <div class="group">
                    <label for="documento">Pessoa Física/Júridica: </label>
                    <input type="text" name="documento" placeholder="Pessoa Física/Júridica">
                </div>
            </div>
            <div class="typesInput">
                <div class="row">
                    <label for="contato" class="typesInputTitle">Contato</label>
                </div>
                <div class="row">
                    <div class="group">
                       <label for="email">Gmail: </label>
                       <input type="email" name="email" id="email" placeholder="E-mail">
                    </div>
                <div class="group">
                    <label for="celular">Celular: </label>
                    <input type="text" name="celular" id="celular" placeholder="Celular">
                </div>
            </div>
            </div>
            <div class="typesInput">
                <div class="row">
                    <label for="endereco" class="typesInputTitle">Endereço</label>
                </div>
                <div class="row">
                    <div class="group">
                       <label for="endereco">Logradouro: </label>
                       <input type="text" name="endereco" id="endereco" placeholder="Rua/Av">
                    </div>
                    <div class="group">
                       <label for="numero">Numero: </label>
                       <input type="text" name="numero" id="numero" value="0" placeholder="Nº">
                    </div>
            </div>
                <div class="row">
                    <div class="group">
                       <label for="bairro">Bairro: </label>
                       <input type="text" name="bairro" id="bairro" placeholder="Bairro">
                    </div>
                    <div class="group">
                        <label for="cidade">Cidade: </label>
                        <input type="text" name="cidade" id="cidade" placeholder="Cidade">
                    </div>
                </div>
                <div class="row">
                    <div class="group">
                       <label for="uf">UF: </label>
                       <input type="text" name="uf" id="uf" placeholder="UF">
                    </div>
                </div>
            </div>
            <div class="row" style="justify-content: center;">
                <button type="submit" name="salvar">Salvar</button>
                <a href="/list.php">
                <div class="button">
                    <span>Lista</span>
                </div>
                </a>
            </div>
        </form>
    </div>
</body>
</html>