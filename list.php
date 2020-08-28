<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/list.css">

    <script src="/js/jquery.min.js"></script>

    <title>List</title>
</head>
<body>
<div class="page">
    <div class="list">
        <h1>List</h1>

        <table>
            <tbody>
            <tr>
                <th>Nome/Razão Social</th>
                <th>CPF/CNPJ</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Logradouro</th>
                <th>Número</th>
                <th>Bairro</th>
                <th>Cidade</th>
                <th>UF</th>
            </tr>
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

                while ($linha = $pessoas->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";

                    echo "<td>{$linha['nome']}</td>";
                    echo "<td>{$linha['cpf']}</td>";
                    echo "<td>{$linha['email']}</td>";

                    $linha['telefone'] = $linha['telefone'] ? $linha['telefone'] : ' - ';
                    $linha['logradouro'] = $linha['logradouro'] ? $linha['logradouro'] : ' - ';
                    $linha['numero'] = $linha['numero'] ? $linha['numero'] : ' - ';
                    $linha['bairro'] = $linha['bairro'] ? $linha['bairro'] : ' - ';
                    $linha['cidade'] = $linha['cidade'] ? $linha['cidade'] : ' - ';
                    $linha['uf'] = $linha['uf'] ? $linha['uf'] : ' - ';

                    echo "<td>{$linha['telefone']}</td>";
                    echo "<td>{$linha['logradouro']}</td>";
                    echo "<td>{$linha['numero']}</td>";
                    echo "<td>{$linha['bairro']}</td>";
                    echo "<td>{$linha['cidade']}</td>";
                    echo "<td>{$linha['uf']}</td>";

                    echo "</tr>";
                }

                while ($linha = $empresas->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";

                    echo "<td>{$linha['razao_social']}</td>";
                    echo "<td>{$linha['cnpj']}</td>";
                    echo "<td>{$linha['email']}</td>";

                    $linha['telefone'] = $linha['telefone'] ? $linha['telefone'] : ' - ';
                    $linha['logradouro'] = $linha['logradouro'] ? $linha['logradouro'] : ' - ';
                    $linha['numero'] = $linha['numero'] ? $linha['numero'] : ' - ';
                    $linha['bairro'] = $linha['bairro'] ? $linha['bairro'] : ' - ';
                    $linha['cidade'] = $linha['cidade'] ? $linha['cidade'] : ' - ';
                    $linha['uf'] = $linha['uf'] ? $linha['uf'] : ' - ';

                    echo "<td>{$linha['telefone']}</td>";
                    echo "<td>{$linha['logradouro']}</td>";
                    echo "<td>{$linha['numero']}</td>";
                    echo "<td>{$linha['bairro']}</td>";
                    echo "<td>{$linha['cidade']}</td>";
                    echo "<td>{$linha['uf']}</td>";
                }

            } catch (PDOException $e) {
                echo "<br>" . $e->getMessage();
            }

            $conn = null;
            ?>
            <script type="text/javascript" src="/js/list.js"></script>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>