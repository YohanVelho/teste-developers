/*
 * ESTE JS É IMPORTADO EM TODAS AS PÁGINAS DO WEBSITE
 */
validaForm = function (f) {
	campos = f.querySelectorAll('[data-obrigatorio="1"]');

	for (i = 0; i < campos.length; i++) {
		funcoes = campos[i].getAttribute("data-funcoes").split("|");
		msgs = campos[i].getAttribute("data-erros").split("|");

		for (j = 0; j < funcoes.length; j++) {
			if (!window[funcoes[j]](campos[i], msgs[j])) return false;
		}
	}

	return true;
};