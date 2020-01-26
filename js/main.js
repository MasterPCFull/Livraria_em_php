$(document).ready(function() {   

    var url = "http://localhost/";

    $("#acervo_cadastro").submit(function(event) {
        event.preventDefault();
        
        var editora = $("#acervo_cad_editora").val();
        var titulo= $("#acervo_cad_titulo").val();
        var ano = $("#acervo_cad_ano").val();
        var quantidade = $("#acervo_cad_quantidade").val();
        var autor = $("#acervo_cad_autor").val();
        var preco = $("#acervo_cad_preco").val();
        var tipo = $("#acervo_cad_tipo").val();
    
        var is_valid = true;

        if(editora.length === 0 || editora === null)
            is_valid = false;

        if(titulo.length === 0 || titulo === null)
            is_valid = false;

        if(ano.length === 0 || ano === null)
            is_valid = false;

        if(quantidade.length === 0 || quantidade === null)
            is_valid = false;

        if(autor.length === 0 || autor === null)
            is_valid = false;

        if(preco.length === 0 || preco === null)
            is_valid = false;

        if(tipo.length === 0 || tipo === null)
            is_valid = false;
    
        url = url + "index.php";

        if (is_valid === true) {
            $.ajax({
                method: "POST",
                url: url,
                data: {
                    cadastro_acervo: true,
                    editora: editora,
                    titulo: titulo,
                    ano: ano,
                    quantidade: quantidade,
                    autor: autor,
                    preco: preco,
                    tipo: tipo
                }
            }).done(function(msg) {
                console.log("Acervo: " + editora + " " + "titulo " + " ano " + ano );
            });
        }
        else
            console.log("Falha durante a validação. Uma ou mais propriedades estão inválidas");   
    });

    $("#acervo_atualizacao").submit(function(event) {
        event.preventDefault();
        
        var id = $("#acervo_atu_id").val();
        var editora = $("#acervo_atu_editora").val();
        var titulo= $("#acervo_atu_titulo").val();
        var ano = $("#acervo_atu_ano").val();
        var quantidade = $("#acervo_atu_quantidade").val();
        var autor = $("#acervo_atu_autor").val();
        var preco = $("#acervo_atu_preco").val();
        var tipo = $("#acervo_atu_tipo").val();
    
        var is_valid = true;

        if(editora.length === 0 || editora === null)
            is_valid = false;

        if(titulo.length === 0 || titulo === null)
            is_valid = false;

        if(ano.length === 0 || ano === null)
            is_valid = false;

        if(quantidade.length === 0 || quantidade === null)
            is_valid = false;

        if(autor.length === 0 || autor === null)
            is_valid = false;

        if(preco.length === 0 || preco === null)
            is_valid = false;

        if(tipo.length === 0 || tipo === null)
            is_valid = false;
    
        url = url + "editar_acervo.php?id=" + id;

        if (is_valid === true) {
            $.ajax({
                method: "POST",
                url: url,
                data: {
                    atualizacao_acervo: true,
                    id: id,
                    editora: editora,
                    titulo: titulo,
                    ano: ano,
                    quantidade: quantidade,
                    autor: autor,
                    preco: preco,
                    tipo: tipo
                }
            }).done(function(msg) {
                console.log('Atualização feita com sucesso');
            });
            console.log(url);
        }
        else
            console.log("Falha durante a validação. Uma ou mais propriedades estão inválidas");   
    });

    $("#editora_cadastro").submit(function(event) {
        event.preventDefault();
        
        var nome = $("#editora_cad_editora").val();
    
        var is_valid = true;

        url = url + "index.php";

        if(nome.length === 0 || nome === null)
            is_valid = false;
    
        if (is_valid) {
            
            $.ajax({
                method: "POST",
                url: url,
                data: {
                    cadastro_editora: true,
                    nome: nome
                }
            }).done(function(msg) {
                
            });
        }
        else
            console.log("Falha durante a validação. Uma ou mais propriedades estão inválidas");   
    });

    $("#editora_atualizacao").submit(function(event) {
        event.preventDefault();
        
        var id = $("#editora_atu_id").val();
        var nome = $("#editora_atu_nome").val();
    
        var is_valid = true;

        url = url + "editar_editora.php?id=" + id;

        if(nome.length === 0 || nome === null)
            is_valid = false;
    
        if (is_valid) {
            
            $.ajax({
                method: "POST",
                url: url,
                data: {
                    atualizacao_editora: true,
                    id: id,
                    nome: nome
                }
            }).done(function(msg) {
                console.log('Atualização feita com sucesso');
            });
        }
        else
            console.log("Falha durante a validação. Uma ou mais propriedades estão inválidas");   
    });
});