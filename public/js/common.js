function confirDeleteForm(theForm,item){
	if(confirm("Realmente deseja remover "+item)){
		$("#" + theForm).submit();
	}
}
function confirRestoreForm(theForm,item){
	if(confirm("Realmente deseja reativar "+item)){
		$("#" + theForm).submit();
	}
}



function resetForm(formId){	
	$("#" + formId)[0].reset();
	$('.error-field').html('');
}
function salvarViatura(urlAction){

	var formData = {
		id     : $("#formViaturas :input[name='id']").val(),
		prefixo    : $("#formViaturas :input[name='prefixo']").val(),
		placa : $("#formViaturas :input[name='placa']").val(),
		modelo  : $("#formViaturas :input[name='modelo']").val(),
		_token  : $("#formViaturas :input[name='_token']").val(),
		ajax : 1
	}
	$('.error-field').html('');
	$.ajax({
		type:"POST",
		// url      : $(this).attr('action') + '/store',
		url      : urlAction ,
		data     : formData,
		cache    : false,               
		success  : function(data) {   
			var objeto = JSON.parse(data); 
			$("#viatura_id").append($("<option>",{
				value: objeto.id , 
				text: objeto.prefixo
			}));                
			$('#viatura_id option[value=' + objeto.id + ']')
			.attr('selected',true);
			$('#formViaturas')[0].reset();
			$("#myModalViaturas").modal('hide');
		},
		error:function(data){
			var errors = data.responseJSON;    
			console.log("err " + errors)            
			for (var key in errors){                         
				$('#myModalViaturas #' +key).parents().children("span").html(errors[key]) ;       
			}
		}
	});

}


function salvarUnidade(urlAction){

	var formData = {
		id     : $("#formUnidades :input[name='id']").val(),
		name    : $("#formUnidades :input[name='name']").val(),
		cidade : $("#formUnidades :input[name='cidade']").val(),
		uf : $("#formUnidades :input[name='uf']").val(),
		rua  : $("#formUnidades :input[name='rua']").val(),
		numero  : $("#formUnidades :input[name='numero']").val(),
		bairro  : $("#formUnidades :input[name='bairro']").val(),
		cep  : $("#formUnidades :input[name='cep']").val(),
		responsavel  : $("#formUnidades :input[name='responsavel']").val(),
		dd1  : $("#formUnidades :input[name='dd1']").val(),
		tel1  : $("#formUnidades :input[name='tel1']").val(),
		dd2  : $("#formUnidades :input[name='dd2']").val(),
		tel2  : $("#formUnidades :input[name='tel2']").val(),
		_token  : $("#formUnidades :input[name='_token']").val(),
		ajax : 1
	}
	$('.error-field').html('');
	$.ajax({
		type:"POST",
		// url      : $(this).attr('action') + '/store',
		url      : urlAction,
		data     : formData,
		cache    : false,               
		success  : function(data) {   
			var objeto = JSON.parse(data); 
			$("#unidade_id").append($("<option>",{
				value: objeto.id , 
				text: objeto.name
			}));                
			$('#unidade_id option[value=' + objeto.id + ']')
			.attr('selected',true);
			$('#formUnidades')[0].reset();
			$("#myModalUnidades").modal('hide');
		},
		error:function(data){
			var errors = data.responseJSON;   
			console.log(data);             
			for (var key in errors){   
				$('#myModalUnidades #' +key).parents().children("span").html(errors[key]) ;                  

			}
		}
	})
}

