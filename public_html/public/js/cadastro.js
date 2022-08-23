/* Validação de Dados */

$(document).ready(function () {
	$("#form-cadastro").validate({
		// Define as regras
		rules: {
			nome: {
				// campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
				required: true, minlength: 2
			},
			email: {
				// campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
				required: true, email: true
			},
			sobrenome: {
				// campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
				required: true, minlength: 2
			},
			senha: {
				required: true, minlength: 5
			},
			confirmar_senha: {
				required: true, minlength: 5,
				equalTo: "#senha"
			}

		},
		// Define as mensagens de erro para cada regra
		messages: {
			nome: {
				required: "Digite o seu nome",
				minLength: "O seu nome deve conter, no mínimo, 2 caracteres"
			},
			email: {
				required: "Digite o seu e-mail para contato",
				email: "Digite um e-mail válido"
			},
			sobrenome: {
				required: "Digite o seu sobrenome",
				minLength: "A seu sobrenome deve conter, no mínimo, 2 caracteres"
			},
			senha: {
				required: "Digite uma senha",
				minLength: "A sua senha deve conter, no mínimo, 5 caracteres"
			},
			confirmar_senha: {
				required: "Digite uma senha",
				minLength: "A sua senha deve conter, no mínimo, 5 caracteres",
				equalTo: "A senha digitada deve ser igual à senha anterior"
			}
		}
	});
});