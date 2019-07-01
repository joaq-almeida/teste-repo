$(document).ready(function(){

	carregarDados();
	$('#btnAtualizarDados').hide();
	$('#btnCancelar').hide();
});

$('#btnCancelar').on('click', function(){

	$('#campoTitulo').val('');
    $('#campoAutor').val('');
    $('#campoAnoLancamento').val('');

	$(this).hide();
	$('#btnAtualizarDados').hide();
	$('#btnCadastrar').show();	
});

$('#btnAtualizarDados').click(function(){

	var id = $('#idDado').val();
	var titulo = $('#campoTitulo').val();
    var autor = $('#campoAutor').val();
    var anoLancamento = $('#campoAnoLancamento').val();
    console.log(id, titulo, autor, anoLancamento);
	atualizarDados(id, titulo, autor, anoLancamento);
	$(this).hide();
	$('#btnCadastrar').show();
});

$(document).on('click', '#btnAtualizar', function(){

	$('#btnCadastrar').hide();

	var id = $(this).val();
	var titulo = $('.tituloData').text();
    var autor = $('.autorData').text();
    var anoLancamento = $('.anoLancamentoData').text();
    
	passarDados(id, titulo, autor, anoLancamento);

	$('#btnAtualizarDados').show();
	$('#btnCancelar').show();
});

$(document).on('click', '#btnDeletar', function(){

	var id = $(this).val();
	alert(id);
	deletarDados(id);
});


$('#btnCadastrar').click(function(e){

	e.preventDefault();

	var titulo = $('#campoTitulo').val();
    var autor = $('#campoAutor').val();
    var anoLancamento = $('#campoAnoLancamento').val();

	salvarDados(titulo, autor, anoLancamento);
});

var passarDados = function(id, titulo, autor, anoLancamento){

	$('#idDado').val(id);
	$('#campoTitulo').val(titulo);
    $('#campoAutor').val(autor);
    $('#campoAnoLancamento').val(anoLancamento);
}

var salvarDados = function(titulo, autor, anoLancamento){

	$.ajax({
		type: 'post',
		url: 'src/controller/LivroController.php',
		data: {
            'cadastrar' : 1,
            'titulo': titulo,
            'autor': autor,
            'anoLancamento': anoLancamento
        },
		success: function(res){
            alert("Inserido com sucesso!!!");
            location.reload();
			console.log(res);
		},
		error: function(res){
			console.log(res);
		}
	});
}

var carregarDados = function(){

	$.ajax({
		url: 'src/controller/LivroController.php',
		success: function(res){
			console.log(res);
			tabelaDados(res);	
		},
		error: function(res){
			console.log(res);
		}
	});	
}

var tabelaDados = function(val){

	var output = '';
	$.each(JSON.parse(val), function(index, dados){
		output += 
		`<tr>
			<td>${dados.codigo}</td>
			<td value="titulo" class="tituloData">${dados.titulo}</td>
            <td value="autor" class="autorData">${dados.autor}</td>
            <td value="anoLancamento" class="anoLancamentoData">${dados.anoLancamento}</td>
			<td><button value="${dados.codigo}" id="btnAtualizar" class="btn" name="atualizar">Editar</button></td>
			<td><button value="${dados.codigo}" id="btnDeletar" class="btn" name="deletar">Deletar</button></td>
		</tr>		   
		`;
	});
	$('tbody').append(output);
}

var deletarDados = function(val){

	$.ajax({
		type: 'get',
		url: 'src/controller/LivroController.php',
		data: {'deletar': 1, 'codigo': val},
		success: function(res){
            console.log(res);
            location.reload();
		},
		error: function(res){
			console.log(res+" DEU RUIM!");
		}
	});
}

var atualizarDados = function(id, titulo, autor, anoLancamento){
	
	$.ajax({
		type: 'post',
		url: 'src/controller/LivroController.php',
		data: {
            'atualizar' : 1,
            'codigo': id,
            'titulo': titulo,
            'autor': autor,
            'anoLancamento': anoLancamento
        },
		success: function(res){
            alert("Atualizado com sucesso!!!");
            location.reload();
			console.log(res);
		},
		error: function(res){
			console.log(res);
		}
	});	
}