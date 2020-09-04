const cells = document.getElementsByTagName('td');
for (let cell of cells) {
    if (cell.innerHTML == ' - ') {
        cell.style.textAlign = 'center';
    }
}

function deleteButton(element) {
    element.on('click', function (event) {
        event.preventDefault();
        const doc = $(this).siblings("input").val();
        Swal.fire({
            title: doc == 'f' ? "Tem certeza que deseja deletar os dados dessa pessoa?" : "Tem certeza que deseja deletar os dados dessa empresa?",
            text: "Essa é uma ação irreversível!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, pode deletar!'
        }).then((result) => {
            if (result.value) {
                $.post(`http://127.0.0.1:8000/dados/delete.php`, { deleteItem: $(this).val(), tipo: doc })
                    .done(function (data) {
                        const resp = JSON.parse(data);
                        if (resp.erro) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Ocorreu um erro!',
                                text: resp.msg
                            });
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deletado!',
                                text: resp.msg,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            setTimeout(function() {
                                window.location.href = 'http://127.0.0.1:8000/list.php'; 
                           }, 1500);
                        }
                    })
                    .fail(function (xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: doc == 'f' ? 'Não foi possível deletar os dados dessa pessoa!' : 'Não foi possível deletar os dados dessa empresa!'
                        });
                    });
            }
        })
    });
}

function logout(element) {
    element.on('click', function (event) {
        event.preventDefault();
        Swal.fire({
            title: 'Tem certeza que deseja sair?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim'
        }).then((result) => {
            if (result.value) {
                $.post(`http://127.0.0.1:8000/list.php`, { logout: true })
                    .done(function (msg) {
                        window.location.href = 'http://127.0.0.1:8000/authenticate/login.php';
                    })
                    .fail(function (xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Não foi possível fazer logout'
                        });
                    });
            }
        })
    });
}