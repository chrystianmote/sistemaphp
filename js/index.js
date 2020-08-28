function mudarNomeCampos() {
    $("input[type='radio']").click(function (e) {
        if (this.id == 'cpf') {
            $(".lbname").html("Nome:");
            $(".lbdocumento").html("CPF:");
            $('input[name=nome]').attr('placeholder', 'Nome');
            $('input[name=documento]').attr('placeholder', 'CPF');
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

        if (cep.length != 8) {
            alert('CEP invalido!');
            return;
        }

        $.get(`https://viacep.com.br/ws/${cep}/json/`, function (data) {
                if (data.erro) {
                    alert('CEP não encontrado!');
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

function SetMascaras() {
    $("#documento").mask('000.000.000-00');
    $("#telefone").mask('(00) 00000-0000');
    $("#cep").mask('00000-000');
}

function validarCPF(elemento) {

    elemento.on('blur', function () {
        let cpf = $(this).val();
        if (cpf.length != 14) {
            alert('CPF inválido!');
        }
        while (cpf.includes('.')) {
            cpf = cpf.replace('.', '');
        }
        cpf = cpf.replace('-', '');
        const digitos = cpf.substring(0, 9);
        const verificadores = cpf.substring(9);
        valdiaPrimeiroDigito(digitos.split(''), verificadores[1]);
    });
}

function valdiaPrimeiroDigito(digitos, primeiroD) {
    let result = 0;
    digitos.forEach((digito, index) => {
        result += digito * (index + 1);
    });
    if ((result % 11) == 10 && primeiroD == 0) {
        return true;
    } else if ((result % 11) == primeiroD) {
        return true;
    } else {
        return false;
    }
}

