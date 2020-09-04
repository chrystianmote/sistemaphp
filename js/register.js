function registrar(element) {
    element.on('click', function(event){
        event.preventDefault();
        if(!validaForm()) {
            return;
        }
        let data = {};
        $("input").serializeArray().forEach(element => data[element.name] = element.value);
        data['registrar'] = true;
        Swal.fire({
            title: "Tem certeza que deseja criar esse usuário?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, pode criar!'
        }).then((result) => {
            if (result.value) {
                $.post(`http://127.0.0.1:8000/dados/register.php`, data)
                    .done(function (msg) {

                        const resp = JSON.parse(msg);
                        if (!resp.erro) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Usuário criado com sucesso!',
                                text: resp.msg,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(()=> window.location.href = 'http://127.0.0.1:8000/index.php');                           
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Ocorreu um erro!',
                                text: resp.msg
                            }).then(function() {
                                if(resp.msg == 'O username já esta sendo utilizado!'){
                                    $("#username").val("");
                                }
                            });
                        }
                    })
                    .fail(function (xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Não foi possível criar esse usuário!'
                        });
                    });
            }
        })
    })
}

function validaForm() {
    const form =  document.getElementsByClassName('needs-validation')[0];
    if (form.checkValidity() === false) {
        form.classList.add('was-validated');
        return false;
    }
    form.classList.add('was-validated');
    return true;
}