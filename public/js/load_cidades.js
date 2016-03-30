
        function estadosSelect(uf, cidade){  
            //fix os espacos
            
            var ufAux=uf.replace(" ","\\ ");
            //fix os espacos
            var cidadeAux=cidade.replace(" ","\\ ");                   
            $('#uf option[value=' + ufAux + ']')
                        .attr('selected',true);
            $("#uf").change();                    
            $('#cidade option[value=' + cidadeAux + ']')
                        .attr('selected',true);
        }

        $(document).ready(function () {
           
            //cuidado com o path... pode ser coloca em uma pasta js
            // ai ficaria $.getJSON('/js/estados_cidades.json', function (data) {
            $.getJSON('/js/estados_cidades.json', function (data) {            
                var items = [];
                var options = '<option value="">'+txtSelEstado+'</option>';    
                $.each(data, function (key, val) {
                    options += '<option value="' + val.sigla + '">' + val.nome + '</option>';
                });                 
                $("#uf").html(options); 
                $("#uf").change(function () {                               
                    var options_cidades = options_cidades += '<option value="">'+txtSelCidade+'</option>';;
                    var str = "";                  
                    
                    $("#uf option:selected").each(function () {
                        str += $(this).text();
                    });
                    
                    $.each(data, function (key, val) {
                        if(val.nome == str) {                           
                            $.each(val.cidades, function (key_city, val_city) {
                                options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
                            });                         
                        }
                    });
                    $("#cidade").html(options_cidades);                    
                }).change();   
                
               
               //aqui seria colocado um valor padrao
               //vamos supor q esteja editando e nao criando..
               //poderia usar sua linguagem de programacao             
                
                //exemplo pratico uf SP e cidade Guarulhos
                estadosSelect(uf_padrao,cidade_padrao);               
            
            });

            
        
        });
