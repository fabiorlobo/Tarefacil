/******/ (() => { // webpackBootstrap
document.addEventListener('DOMContentLoaded', function () {
	function atualizarResumo() {
		const listaId = document.querySelector('h1.title').getAttribute('data-lista-id');
		if (!listaId) {
			console.error('Erro: listaId está nulo.');
			return;
		}
		
		fetch(`/painel/listas/${listaId}/resumo`)
			.then(response => response.json())
			.then(data => {
				const tempoReservadoEl = document.querySelector('.box__item .tempo-reservado');
				if (tempoReservadoEl) {
					tempoReservadoEl.innerHTML = `${data.tempoReservadoHoras} hora${data.tempoReservadoHoras != 1 ? 's' : ''} e ${data.tempoReservadoMinutos} minuto${data.tempoReservadoMinutos != 1 ? 's' : ''}`;
				}

				const tempoTrabalhadoEl = document.querySelector('.box__item .tempo-trabalhado');
				if (tempoTrabalhadoEl) {
					tempoTrabalhadoEl.innerHTML = `${data.tempoTrabalhadoHoras} hora${data.tempoTrabalhadoHoras != 1 ? 's' : ''} e ${data.tempoTrabalhadoMinutos} minuto${data.tempoTrabalhadoMinutos != 1 ? 's' : ''}`;
				}

				const tempoRestanteEl = document.querySelector('.box__item .tempo-restante');
				if (tempoRestanteEl) {
					tempoRestanteEl.innerHTML = `${data.tempoRestanteHoras} hora${data.tempoRestanteHoras != 1 ? 's' : ''} e ${data.tempoRestanteMinutos} minuto${data.tempoRestanteMinutos != 1 ? 's' : ''}`;
				}

				const tempoExcedidoEl = document.querySelector('.box__item .tempo-excedido');
				if (tempoExcedidoEl) {
					tempoExcedidoEl.innerHTML = `${data.tempoExcedidoHoras} hora${data.tempoExcedidoHoras != 1 ? 's' : ''} e ${data.tempoExcedidoMinutos} minuto${data.tempoExcedidoMinutos != 1 ? 's' : ''}`;
				}

				const totalTarefasEl = document.querySelector('.box__item .total-tarefas');
				if (totalTarefasEl) {
					totalTarefasEl.innerHTML = `${data.totalTarefas} (${data.tarefasConcluidas} concluída${data.tarefasConcluidas != 1 ? 's' : ''}, ${data.tarefasPendentes} pendente${data.tarefasPendentes != 1 ? 's' : ''})`;
				}

			})
			.catch(error => console.error('Erro ao atualizar o resumo:', error));
	}

	document.querySelectorAll('.loop__item__checkbox, .actions__button').forEach(el => {
		el.addEventListener('change', atualizarResumo);
		el.addEventListener('click', atualizarResumo);
	});

	window.addEventListener('stop-tracker', function () {
		atualizarResumo();
	});

	window.addEventListener('concluir-tarefa', function () {
		atualizarResumo();
	});
});
/******/ })()
;