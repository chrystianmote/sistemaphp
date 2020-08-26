<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<?php
if (isset($_POST['salvar'])) {

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

        if (strlen($documento) > 11) {
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

    } catch (PDOException $e) {
        echo "<br>" . $e->getMessage();
    }

    $conn = null;
}
?>
    <div class="page">
        <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <h1>Cadastro</h1>
            <div class="row">
                <label for="contato" class="typesInputTitle">Categoria :</label>
            </div>
            <div class="rowRadio">
                <input class="radio" id="cpf" type="radio" name="category" checked>
                <span>Pessoa Física</span>
            </div>
            <div class="rowRadio">
                <input class="radio" id="cnpj" type="radio" name="category">
                <span>Pessoa Jurídica</span>
            </div>
            <div class="row">
                <div class="group">
                    <label id="nome" for="nome">Nome: </label>
                    <input type="text" name="nome" placeholder="Nome">
                </div>
                <div class="group">
                    <label id="documento" for="documento">Pessoa Física: </label>
                    <input type="text" name="documento" placeholder="Pessoa Física">
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


                <div class="group">
                       
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

    <script>
        var category = null;
        $("input[name='category']").click(function() {
            category = this.value;
            if(this.id == 'cpf') {
               document.getElementById('nome').innerHTML = 'Nome:';
               document.getElementById('documento').innerHTML = 'Pessoa Física:';
               $('input[name=nome]').attr('placeholder','Nome');
               $('input[name=documento]').attr('placeholder','Pessoa Física');
            } else {
                document.getElementById('nome').innerHTML = 'Razão Social:';
                document.getElementById('documento').innerHTML = 'Pessoa Júridica:';
                $('input[name=nome]').attr('placeholder','Razão Social');
                $('input[name=documento]').attr('placeholder','Pessoa Júridica');
            }
        });
    </script>
</body>
</html>