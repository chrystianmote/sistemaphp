<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="list.css">
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
                        // (razao_social, cnpj, email, telefone, logradouro, numero, bairro, cidade, uf
                        while ($linha = $pessoas->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            
                            echo "<td>{$linha['nome']}</td>";

                            $cpf1 = substr($linha['cpf'], 0, 3);
                            $cpf2 = substr($linha['cpf'], 3, 3);
                            $cpf3 = substr($linha['cpf'], 6, 3);
                            $cpf4 = substr($linha['cpf'], 9);

                            echo "<td>$cpf1.$cpf2.$cpf3-$cpf4</td>";
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

                            $cnpj1 = substr($linha['cnpj'], 0, 2);
                            $cnpj2 = substr($linha['cnpj'], 2, 3);
                            $cnpj3 = substr($linha['cnpj'], 5, 3);
                            $cnpj4 = substr($linha['cnpj'], 8, 4);
                            $cnpj5 = substr($linha['cnpj'], 12);
                            
                            echo "<td>$cnpj1.$cnpj2.$cnpj3/$cnpj4-$cnpj5</td>";
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
                        
                    } catch(PDOException $e) {
                        echo "<br>" . $e->getMessage();
                    }
                    
                    $conn = null;
                    echo "
                        <script type=\"text/javascript\">
                            const cells = document.getElementsByTagName('td');
                            for (let cell of cells) {
                                if(cell.innerHTML == ' - '){
                                    cell.style.textAlign  = 'center';
                                }
                            }
                        </script>
                    ";
                ?>
            </tbody>
            <script type=\"text/javascript\">
                
            </script>
            </table>
        </div>    
    </div>
</body>
</html>