<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>List</title>
</head>
<body>
    <div class="page">
        <div class="list">
            <h1>List</h1>

            <div class="row">
                <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "root";
                    $dbname = "cadastro";     
                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        // set the PDO error mode to exception
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $pessoas = $conn->query("SELECT * FROM pessoa;");
                        $empresas = $conn->query("SELECT * FROM empresa;");
                        // (razao_social, cnpj, email, telefone, logradouro, numero, bairro, cidade, uf
                        echo "Lista de Pessoas: <br/><br/>";
                        while ($linha = $pessoas->fetch(PDO::FETCH_ASSOC)) {
                            echo "Nome: {$linha['nome']} - CPF: {$linha['cpf']} - Email: {$linha['email']} - ";
                            
                            $linha['telefone'] = $linha['telefone'] ? $linha['telefone'] : 'N/A';
                            $linha['logradouro'] = $linha['logradouro'] ? $linha['logradouro'] : 'N/A';
                            $linha['numero'] = $linha['numero'] ? $linha['numero'] : 'N/A';
                            $linha['bairro'] = $linha['bairro'] ? $linha['bairro'] : 'N/A';
                            $linha['cidade'] = $linha['cidade'] ? $linha['cidade'] : 'N/A';
                            $linha['uf'] = $linha['uf'] ? $linha['uf'] : 'N/A';
                            
                            echo "Telefone: {$linha['telefone']} - Logradouro:{$linha['logradouro']} - Nº:{$linha['numero']} - ";
                            echo "Bairro: {$linha['bairro']} - Cidade:{$linha['cidade']} - UF:{$linha['uf']}<br /><br />";
                        }
                        echo "Lista de Empresas: <br/><br/>";
                        while ($linha = $empresas->fetch(PDO::FETCH_ASSOC)) {
                            echo "Razão Social: {$linha['razao_social']} - CNPJ: {$linha['cnpj']} - Email: {$linha['email']} - ";
                            
                            $linha['telefone'] = $linha['telefone'] ? $linha['telefone'] : 'N/A';
                            $linha['logradouro'] = $linha['logradouro'] ? $linha['logradouro'] : 'N/A';
                            $linha['numero'] = $linha['numero'] ? $linha['numero'] : 'N/A';
                            $linha['bairro'] = $linha['bairro'] ? $linha['bairro'] : 'N/A';
                            $linha['cidade'] = $linha['cidade'] ? $linha['cidade'] : 'N/A';
                            $linha['uf'] = $linha['uf'] ? $linha['uf'] : 'N/A';
                            
                            echo "Telefone: {$linha['telefone']} - Logradouro:{$linha['logradouro']} - Nº:{$linha['numero']} - ";
                            echo "Bairro: {$linha['bairro']} - Cidade:{$linha['cidade']} - UF:{$linha['uf']}<br /><br />";
                        }
                        
                    } catch(PDOException $e) {
                        echo "<br>" . $e->getMessage();
                    }
                    
                    $conn = null;
                ?>
            </div>
        </div>    
    </div>
</body>
</html>