jQuery(document).ready(function ($){

    $("#documento").mask('000.000.000-00');
    $("#telefone").mask('(00) 00000-0000');
    $("#cep").mask('000000-000');

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
});