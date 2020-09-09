function cep() {
    $("#cep").on('blur', function (e) {
        const cep = $(this).val().replace('-', '');

        if(cep.length == 0) {
            return;
        }

        if (cep.length != 8) {
            Swal.fire({
                icon: 'error',
                title: 'CEP inválido!'
            });
            $(this).val("");
            return;
        }

        $.get(`https://viacep.com.br/ws/${cep}/json/`, function (data) {
                if (data.erro) {
                    Swal.fire({
                        icon: 'error',
                        title: 'CEP não encontrado!'
                    });
                    $("#cep").val("");
                    return;
                } else {
                    $('#endereco').val(data.logradouro);
                    $('#bairro').val(data.bairro);
                    $('#cidade').val(data.localidade);
                    $("option[value=" + data.uf + "]")
                        .attr("selected", true).siblings()
                        .removeAttr("selected");
                }
            }
        )
    })
}

function changeForm(oldValues) {
    $("form :input").change(function() {
        let change = false;
        const data = getFormValues();
        for (let key of Object.keys(data)) {
            if(data[key] != oldValues[key]) {
                change = true;
                break;
            }
        }
        if(change) {
            $("button[name='atualizar']").removeAttr("disabled");
        } else {
            $("button[name='atualizar']").attr("disabled", true);
        }
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

function mascaraEmail() {
    $("#email").on('blur', function () {
        if ($(this).val() == "") {
            return;
        }
        const email = $(this).val().split("@");
        if (email.length != 2 || email[1] == "") {
            $(this).val("");
            Swal.fire({
                icon: 'error',
                title: 'Email inválido!'
            });
        } else {
            if (email[1].includes('.')) {
                const verificaPontos = email[1].split(".").find(element => element == "");
                if (verificaPontos != undefined) {
                    $(this).val("");
                    Swal.fire({
                        icon: 'error',
                        title: 'Email inválido!'
                    });
                }
            } else {
                $(this).val("");
                Swal.fire({
                    icon: 'error',
                    title: 'Email inválido!'
                });
            }
        }
    });
}

function mascaraTelefone(element) {
    if(element.val().length <= 14) {
        $("#telefone").mask('(00) 0000-00000');
    } else {
        $("#telefone").mask('(00) 00000-0000');
    }
}

function mudarNomeCampos() {
    $("input[type='radio']").click(function (e) {
        if (this.id == 'cpf') {
            $(".lbname").html("Nome:");
            $(".lbdocumento").html("CPF:");
            $('input[name=nome]').attr('placeholder', 'Nome');
            $('input[name=documento]').attr('placeholder', 'CPF');
            $("#documento").val('');
            $("#documento").mask('000.000.000-00');
        } else {

            $(".lbname").html("Razão Social:");
            $(".lbdocumento").html("CNPJ:");
            $('input[name=nome]').attr('placeholder', 'Razão Social');
            $('input[name=documento]').attr('placeholder', 'CNPJ');
            $("#documento").val('');
            $("#documento").mask('00.000.000/0000-00');
        }
    });
}

function getFormValues() {
    let data = {};
    $("input").serializeArray().forEach(element => {
        if(element.name != "cep") {
            data[element.name] = element.value;
        }
    });
    data['uf'] = $("option[selected='selected']").val();
    return data;
}

function salvar(element) {
    element.on('click', function (event) {
        let data = {};
        event.preventDefault();
        if(!validaForm()) {
            return;
        }
        $("input[type='text']").serializeArray().forEach(element => {
            if(element.name != "cep") {
                data[element.name] = element.value;
            }
        });
        data['email'] = $("input[type='email']").val();
        data['uf'] = $("option[selected='selected']").val();
        data['salvar'] = true;
        const cpf = $('#cpf').is(':checked');
        Swal.fire({
            title: cpf ? "Tem certeza que deseja salvar os dados dessa pessoa?" : "Tem certeza que deseja salvar os dados dessa empresa?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, pode salvar!',
        }).then((result) => {
            Swal.fire({
                html: "<div class='mySpinner'><div class='half-circle-spinner'><div class='circle circle-1'></div> <div class='circle circle-2'></div></div></div>",
                background: "rgba(0,0,0,0)",
                showConfirmButton: false,
                timer: 2500
            })
            setTimeout(function() {
                if (result.value) {
                    $.post(`http://127.0.0.1:8000/dados/create.php`, data)
                        .done(function (msg) {
                            const resp = JSON.parse(msg);
                            if (!resp.erro) {
                                Swal.fire({
                                    icon: 'success',
                                    title: cpf ? 'Pessoa criada com sucesso!': 'Empresa criada com sucesso!',
                                    text: resp.msg,
                                    showConfirmButton: false,
                                    timer: 2500,
                                }).then(() => window.location.href = 'http://127.0.0.1:8000/index.php');                           
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ocorreu um erro!',
                                    text: resp.msg
                                })
                            }
                        })
                        .fail(function (xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: doc == 'f' ? 'Não foi possível salvar os dados dessa pessoa!' : 'Não foi possível salvar os dados dessa empresa!'
                            });
                        });
                }
            }, 2500);
                
        })
    });
}

function select(element) {
    element.on('change', function() {
        $("option[value=" + this.value + "]", this)
        .attr("selected", true).siblings()
        .removeAttr("selected")
    })
}

function SetMascaras() {
    
    $("#telefone").mask('(00) 00000-0000');
    $("#cep").mask('00000-000');

    if($("#cpf").attr("checked") != undefined) {
        $("#documento").mask('000.000.000-00');
    } else {
        $(".lbname").html("Razão Social:");
        $(".lbdocumento").html("CNPJ:");
        $('input[name=nome]').attr('placeholder', 'Razão Social');
        $('input[name=documento]').attr('placeholder', 'CNPJ');
        $("#documento").mask('00.000.000/0000-00');
    }

}

function update(element) {
    element.on('click', function (event) {
        let data = {};
        const url = window.location.search;
        const id = url.substring(url.lastIndexOf('d') + 2, url.lastIndexOf('&'));
        event.preventDefault();
        if(!validaForm()) {
            return ;
        }
        $("input[type='text']").serializeArray().forEach(element => {
            if(element.name != "cep") {
                data[element.name] = element.value;
            }
        });
        data['email'] = $("input[type='email']").val();
        data['uf'] = $("option[selected='selected']").val();
        data['atualizar'] = true;
        data['id'] = id;
        const cpf = $('#cpf').is(':checked');
        Swal.fire({
            title: cpf ? "Tem certeza que deseja atualizar os dados dessa pessoa?" : "Tem certeza que deseja atualizar os dados dessa empresa?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, pode atualizar!',
        }).then((result) => {
            if (result.value) {
                $.post(`http://127.0.0.1:8000/dados/update.php`, data)
                    .done(function (msg) {

                        const resp = JSON.parse(msg);
                        if (!resp.erro) {
                            Swal.fire({
                                icon: 'success',
                                title: cpf ? 'Os dados dessa pessoa foram atualizado com sucesso!': 'Os dados dessa empresa foram atualizado com sucesso!',
                                text: resp.msg,
                                showConfirmButton: false,
                                timer: 3500,
                                timerProgressBar: true,
                            }).then(() => window.location.href = 'http://127.0.0.1:8000/list.php');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Ocorreu um erro!',
                                text: resp.msg,
                            })
                        }
                    })
                    .fail(function (xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: doc == 'f' ? 'Não foi possível atualizar os dados dessa pessoa!' : 'Não foi possível atualizar os dados dessa empresa!'
                        })
                    });
            }
        })
    });
}

function validaCpfCnpj(val) {
    if (val.length == 14) {
        let cpf = val.trim();
     
        cpf = cpf.replace(/\./g, '');
        cpf = cpf.replace('-', '');
        cpf = cpf.split('');
        
        let v1 = 0;
        let v2 = 0;
        let aux = false;
        
        for (let i = 1; cpf.length > i; i++) {
            if (cpf[i - 1] != cpf[i]) {
                aux = true;   
            }
        } 
        
        if (aux == false) {
            return false; 
        } 
        
        for (let i = 0, p = 10; (cpf.length - 2) > i; i++, p--) {
            v1 += cpf[i] * p; 
        } 
        
        v1 = ((v1 * 10) % 11);
        
        if (v1 == 10) {
            v1 = 0; 
        }
        
        if (v1 != cpf[9]) {
            return false; 
        } 
        
        for (let i = 0, p = 11; (cpf.length - 1) > i; i++, p--) {
            v2 += cpf[i] * p; 
        } 
        
        v2 = ((v2 * 10) % 11);
        
        if (v2 == 10) {
            v2 = 0; 
        }
        
        if (v2 != cpf[10]) {
            return false; 
        } else {   
            return true; 
        }
    } else if (val.length == 18) {
        let cnpj = val.trim();
        
        cnpj = cnpj.replace(/\./g, '');
        cnpj = cnpj.replace('-', '');
        cnpj = cnpj.replace('/', ''); 
        cnpj = cnpj.split(''); 
        
        let v1 = 0;
        let v2 = 0;
        let aux = false;
        
        for (let i = 1; cnpj.length > i; i++) { 
            if (cnpj[i - 1] != cnpj[i]) {  
                aux = true;   
            } 
        } 
        
        if (aux == false) {  
            return false; 
        }
        
        for (let i = 0, p1 = 5, p2 = 13; (cnpj.length - 2) > i; i++, p1--, p2--) {
            if (p1 >= 2) {  
                v1 += cnpj[i] * p1;  
            } else {  
                v1 += cnpj[i] * p2;  
            } 
        } 
        
        v1 = (v1 % 11);
        
        if (v1 < 2) { 
            v1 = 0; 
        } else { 
            v1 = (11 - v1); 
        } 
        
        if (v1 != cnpj[12]) {  
            return false; 
        } 
        
        for (let i = 0, p1 = 6, p2 = 14; (cnpj.length - 1) > i; i++, p1--, p2--) { 
            if (p1 >= 2) {  
                v2 += cnpj[i] * p1;  
            } else {   
                v2 += cnpj[i] * p2; 
            } 
        }
        
        v2 = (v2 % 11); 
        
        if (v2 < 2) {  
            v2 = 0;
        } else { 
            v2 = (11 - v2); 
        } 
        
        if (v2 != cnpj[13]) {   
            return false; 
        }
        return true; 
    } else {
        return false;
    }
}

function validarDocumento(element) {
    element.on('blur', function() {

        let documento = $(this).val();

        if(!validaCpfCnpj(documento) && documento != "") {

            $(this).val("");

            if($('#cpf').is(':checked')) {
                Swal.fire({
                    icon: 'error',
                    title: 'CPF inválido!'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'CNPJ inválido!'
                });
            }
        }
    });
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

function validaNumero(element) {
    element.on('blur', function () {
        const numero = $(this).val();
        const regex = /^[0-9]*$/;
        if(!regex.test(numero)) {
            if(numero != "S/D") {
                element.val("");
                Swal.fire({
                    icon: 'error',
                    title: 'Entrada inválida, campo aceita apenas número ou "S/D"!'
                });
            }
        }
    })
}

function validaTelefone(element) {
    element.on('change keyup', function(){
        mascaraTelefone(element);
    });
    element.on('blur', function(){
        const telefone = $(this).val(); 
        if(telefone.length == 0) {
            return;
        } else if(telefone.length < 14) {
            $(this).val("");
            Swal.fire({
                icon: 'error',
                title: 'Tel/Cel inválido!'
            });
            return;
        }
        const ddd = telefone.trim(" ");
        if(ddd[1] == "0" || (ddd[1] == "1" && ddd[2] == "0")) {
            $(this).val("");
            Swal.fire({
                icon: 'error',
                title: 'DDD inválido!'
            });
            return;
        }
        const numerosTelefone = telefone.replace(/\-|\)|\(| /g, '').substring(2);
        const regex = /^(.)\1+$/;
        if(regex.test(numerosTelefone)) {
            $(this).val("");
            Swal.fire({
                icon: 'error',
                title: 'Tel/Cel inválido!'
            });
        }
    });
}