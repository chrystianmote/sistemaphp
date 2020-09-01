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

function cep() {
    $("#cep").on('blur', function (e) {
        const cep = $(this).val().replace('-', '');

        if(cep.length == 0) {
            return;
        }

        if (cep.length != 8) {
            alert('CEP invalido!');
            return;
        }

        $.get(`https://viacep.com.br/ws/${cep}/json/`, function (data) {
                if (data.erro) {
                    alert('CEP não encontrado!');
                    $("#cep").val("");
                    return;
                } else {
                    $('#endereco').val(data.logradouro);
                    $('#bairro').val(data.bairro);
                    $('#cidade').val(data.localidade);
                    $('#uf').val(data.uf);
                }
            }
        )
    })
}

function mascaraEmail() {
    $("#email").on('blur', function () {
        if ($(this).val() == "") {
            return;
        }
        const email = $(this).val().split("@");
        if (email.length != 2 || email[1] == "") {
            $(this).val("");
            alert('Email inválido');
        } else {
            if (email[1].includes('.')) {
                const verificaPontos = email[1].split(".").find(element => element == "");
                if (verificaPontos != undefined) {
                    $(this).val("");
                    alert('Email inválido');
                }
            } else {
                $(this).val("");
                alert('Email inválido');
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
                alert('CPF inválido!');
            } else {
                alert('CNPJ inválido!');
            }
        }
    });
}

function validaNumero(element) {
    element.on('blur', function () {
        const numero = $(this).val();
        const regex = /^[0-9]*$/;
        if(!regex.test(numero)) {
            if(numero != "S/D") {
                alert('Entrada inválida, campo aceita apenas número ou "S/D"!')
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
            alert('Tel/Cel inválido');
            return;
        }
        const ddd = telefone.trim(" ");
        if(ddd[1] == "0" || (ddd[1] == "1" && ddd[2] == "0")) {
            $(this).val("");
            alert('DDD inválido');
            return;
        }
        const numerosTelefone = telefone.replace(/\-|\)|\(| /g, '').substring(2);
        const regex = /^(.)\1+$/;
        if(regex.test(numerosTelefone)) {
            $(this).val("");
            alert('Tel/Cel inválido');
        }
    });
}