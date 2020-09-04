<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/list.css">
    <link rel="icon" href="download.png" type="image/png" sizes="16x16">

    <script src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/sweetalert2.js"></script>

    <title>List</title>
</head>
<body>
<div class="page">
    <div class="list">
        <div class="row">
            <div class="col-6 d-flex justify-content-end">
                <h1>List</h1>
            </div>
            <div class="col-6 d-flex justify-content-end align-self-center pr-3">
                <form action='' method='post'>
                    <button type="submit" value="logout" name="logout" class="btn btn-secondary">logout</button>
                </form>
            </div>
        </div>
            <table class="table table-striped">
                
                <thead>
                    <tr>
                        <th scope="col">Nome/Razão Social</th>
                        <th scope="col">CPF/CNPJ</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Logradouro</th>
                        <th scope="col">Número</th>
                        <th scope="col">Bairro</th>
                        <th scope="col">Cidade</th>
                        <th scope="col">UF</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>    
                <tbody>
                <?php
                require('authenticate/authenticate.php');
                
                include "BDUtil.php";
                try {
                    $pessoas = BDUtil::GetPessoas();
                    $empresas = BDUtil::GetEmpresas();

                    if($pessoas['erro']) {
                        echo  "<script type='text/javascript'>
                                Swal.fire({
                                    position: 'bottom-end',
                                    timer: 2000,
                                    timerProgressBar: true,
                                    title: '{$pessoas['msg']}',
                                    showCloseButton: true,
                                    showConfirmButton: false
                                });
                            </script>";
                    } else {
                        for($i = 0; $i < count($pessoas['msg']);$i++) {
                            $linha = $pessoas['msg'][$i];
                            echo "<tr>";
                            
                            echo "<td>{$linha['nome']}</td>";
                            echo "<td>{$linha['cpf']}</td>";
                            echo "<td>{$linha['email']}</td>";
        
                            $linha['telefone'] = $linha['telefone'] ? $linha['telefone'] : ' - ';
                            $linha['logradouro'] = $linha['logradouro'] ? $linha['logradouro'] : ' - ';
                            $linha['numero'] = $linha['numero'] ? $linha['numero'] : 'S/D';
                            $linha['bairro'] = $linha['bairro'] ? $linha['bairro'] : ' - ';
                            $linha['cidade'] = $linha['cidade'] ? $linha['cidade'] : ' - ';
                            $linha['uf'] = $linha['uf'] ? $linha['uf'] : ' - ';
                            
                            echo "<td>{$linha['telefone']}</td>";
                            echo "<td>{$linha['logradouro']}</td>";
                            echo "<td>{$linha['numero']}</td>";
                            echo "<td>{$linha['bairro']}</td>";
                            echo "<td>{$linha['cidade']}</td>";
                            echo "<td>{$linha['uf']}</td>";
                            echo "<td class='d-flex'>
                                    <a href='index.php?id={$linha['id']}&tipo=f' class='btn btn-outline-secondary mr-1'>
                                    <svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-pencil-square' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                        <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                        <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                                </svg></a>";
                            echo "<form action='' method='post'>
                                    <input type='hidden' name='tipo' value='f'>
                                    <button type='submit' name='deleteItem' value='{$linha['id']}' class='btn btn-outline-danger'>
                                        <svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-trash' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                            <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
                                            <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
                                        </svg>
                                    </button>
                                    </form></td>";
                                
                            echo "</tr>";
                        }
                    }

                    if ($empresas['erro']) {
                        echo  "<script type='text/javascript'>
                                    Swal.fire({
                                        position: 'bottom-end',
                                        timer: 2000,
                                        timerProgressBar: true,
                                        title: '{$empresas['msg']}',
                                        showCloseButton: true,
                                        showConfirmButton: false
                                    });
                                </script>"; 
                    } else {
                        for($i = 0; $i < count($empresas['msg']);$i++) {
                            $linha = $empresas['msg'][$i];
                            echo "<tr>";
    
                            echo "<td>{$linha['razao_social']}</td>";
                            echo "<td>{$linha['cnpj']}</td>";
                            echo "<td>{$linha['email']}</td>";
    
                            $linha['telefone'] = $linha['telefone'] ? $linha['telefone'] : ' - ';
                            $linha['logradouro'] = $linha['logradouro'] ? $linha['logradouro'] : ' - ';
                            $linha['numero'] = $linha['numero'] ? $linha['numero'] : 'S/D';
                            $linha['bairro'] = $linha['bairro'] ? $linha['bairro'] : ' - ';
                            $linha['cidade'] = $linha['cidade'] ? $linha['cidade'] : ' - ';
                            $linha['uf'] = $linha['uf'] ? $linha['uf'] : ' - ';
    
                            echo "<td>{$linha['telefone']}</td>";
                            echo "<td>{$linha['logradouro']}</td>";
                            echo "<td>{$linha['numero']}</td>";
                            echo "<td>{$linha['bairro']}</td>";
                            echo "<td>{$linha['cidade']}</td>";
                            echo "<td>{$linha['uf']}</td>";
    
                            echo "<td class='d-flex'>
                                    <a href='index.php?id={$linha['id']}&tipo=j' class='btn btn-outline-secondary mr-1'>
                                    <svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-pencil-square' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                        <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                        <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                                </svg></a>";
                            echo "<form action='' method='post'>
                                    <input type='hidden' name='tipo' value='j'>
                                    <button type='submit' name='deleteItem' value='{$linha['id']}' class='btn btn-outline-danger'>
                                            <svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-trash' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                                <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
                                                <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
                                            </svg>
                                    </button>
                                </form></td>";
                                
                            echo "</tr>";
                        }
                    }                
                              
                } catch (PDOException $e) {
                    echo "<br>" . $e->getMessage();
                }

                if(isset($_POST['logout'])) {
                    session_unset();
                }
                ?>
                <script type="text/javascript" src="/js/list.js"></script>
                <script type="text/javascript">
                    jQuery(document).ready(function ($) {
                        deleteButton($("button[name='deleteItem']"));
                        logout($("button[name='logout']"));
                    });
                </script>
                </tbody>
            </table>
    </div>
</div>
</body>
</html>