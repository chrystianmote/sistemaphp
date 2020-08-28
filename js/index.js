
function mudarNomeCampos() {
    $("input[type='radio']").click(function(e) {
        if(this.id == 'cpf') {
            $(".lbname").html("Nome:");
            $(".lbdocumento").html("CPF:");
            $('input[name=nome]').attr('placeholder','Nome');
            $('input[name=documento]').attr('placeholder','CPF');
            $("#documento").mask('000.000.000-00');
        } else {
            
            $(".lbname").html("Razão Social:");
            $(".lbdocumento").html("CNPJ:");
            $('input[name=nome]').attr('placeholder','Razão Social');
            $('input[name=documento]').attr('placeholder','CNPJ');
            $("#documento").val('');
            $("#documento").mask('00.000.000/0000-00');
        }
    });
}

function cep() {
    $("#cep").on('blur', function(e) {
        const cep = $(this).val().replace('-', '');

        if(cep.length != 8) {
            alert('CEP invalido!');
            return;
        }

        $.get(`https://viacep.com.br/ws/${cep}/json/`,function(data) {
            if(data.erro) {
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

jQuery(document).ready(function ($){

    $("#documento").mask('000.000.000-00');
    $("#telefone").mask('(00) 00000-0000');
    $("#cep").mask('00000-000');

    mudarNomeCampos();
    cep();
    
});