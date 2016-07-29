/* Arquivo principal JS */
$(function() {
    $('#AjaxRequest').submit(function() {
        // outra forma de recuperar todos dados do formulario
        var form = $(this).serealize();

        // metodo semelhante ao serealize()
        // porem ele traz os dados no formato de Array
        // var formArray = $(this).serealizeArray();

        //console.log(form); // testando form
        //console.log(formArray); // testando formArray

        // usando o Ajax do JQuery
        var request = $.ajax({
            // vamos passar parametros aqui
            method: "POST",
            //url - destino da nossa requisicao
            url: "post.php",
            // vamos capturar os dados da nossa requisição
            /*
            data: {
                name: $(':input[name=name]').val(),
                email: $(':input[name=email]').val(),
                tel: $(':input[name=tel]').val()
            }
            */

            /* Outra forma e pegar os dados usando data() */

            data: form, // ou formArray
            datatype: "json" // escolher o tipo do retorno
                /* Se não retornarmos um XML ele vai dar erro */
        });

        // e - variavel que vai receber os dados do request
        // always() - serve para executar uma ação quando houve sucesso do request
        request.always(function(e) {
            console.log("Always" + e);
        });

        // retorno de sucesso - Done
        request.done(function(e) {
            console.log("done" + e);
            for (var k in e) {
                // Acessando o valor dos dados com for
                $(':input[name=' + k + ']').val(e[k]);
            }
        });

        // Quando der algum erro - Fail()
        request.fail(function(e) {
            console.log("fail" + e);
        });

        // Impede a atualização da pagina         
        return false;
    });
});