let timers = {};
let isTracking = false;
let currentTarefaId = null;

function startTracker(tarefaId) {
		console.log('startTracker chamado para tarefa', tarefaId);
		if (!timers[tarefaId]) {
				fetch(`/painel/tarefas/${tarefaId}/start`, {
						method: 'POST',
						headers: {
								'Content-Type': 'application/json',
								'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
						}
				}).then(response => response.json()).then(data => {
						if (data.status === 'success') {
								const startTime = new Date(data.start_time + 'Z').getTime();
								timers[tarefaId] = {
										startTime: startTime,
										tempoUtilizadoHoras: parseInt(data.tempo_utilizado_horas) || 0,
										tempoUtilizadoMinutos: parseInt(data.tempo_utilizado_minutos) || 0,
										interval: setInterval(() => updateTimer(tarefaId), 1000)
								};

								isTracking = true;
								currentTarefaId = tarefaId;
								window.onbeforeunload = handleBeforeUnload;

								const startBtn = document.querySelector(`#start-btn-${tarefaId}`);
								const stopBtn = document.querySelector(`#stop-btn-${tarefaId}`);
								console.log('Botões encontrados:', startBtn, stopBtn);
								if (startBtn && stopBtn) {
										startBtn.style.display = 'none';
										stopBtn.style.display = 'flex';
								} else {
										console.error(`Botões de iniciar/parar não encontrados para tarefa ${tarefaId}`);
								}
						}
				});
		}
}

function stopTracker(tarefaId, forceStop = false) {
		console.log('stopTracker chamado para tarefa', tarefaId);
		const timer = timers[tarefaId];
		if (!timer) return;

		const elapsedTime = Math.floor((Date.now() - timer.startTime) / 1000);
		if (!forceStop && elapsedTime < 60) {
				if (!confirm('Tempo insuficiente para registrar. Deseja parar mesmo assim?')) {
						return;
				}
		}

		fetch(`/painel/tarefas/${tarefaId}/stop`, {
				method: 'POST',
				headers: {
						'Content-Type': 'application/json',
						'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
				},
				body: JSON.stringify({ elapsedTime: forceStop ? 0 : elapsedTime })
		}).then(response => response.json()).then(data => {
				if (data.status === 'success') {
						clearInterval(timer.interval);
						delete timers[tarefaId];
						isTracking = false;
						window.onbeforeunload = null;
						updateTaskUI(tarefaId, data.tempo_utilizado_horas, data.tempo_utilizado_minutos);
				} else if (data.status === 'already_stopped') {
						alert('A tarefa já foi encerrada.');
				}
		});
}

function updateTimer(tarefaId) {
		const timer = timers[tarefaId];
		if (!timer || !timer.startTime) return;

		const elapsedTime = Math.floor((Date.now() - timer.startTime) / 1000);

		const additionalHours = Math.floor(elapsedTime / 3600);
		const additionalMinutes = Math.floor((elapsedTime % 3600) / 60);
		const additionalSeconds = elapsedTime % 60;

		const timerElement = document.querySelector(`#timer-${tarefaId}`);
		if (timerElement) {
				const currentText = timerElement.textContent.split(' (+')[0];
				const runningTime = `(+${additionalHours}h ${additionalMinutes}m ${additionalSeconds}s)`;
				
				timerElement.textContent = `${currentText} ${runningTime}`;
		}
}

function updateTaskUI(tarefaId, horas, minutos) {
    const startBtn = document.querySelector(`#start-btn-${tarefaId}`);
    const stopBtn = document.querySelector(`#stop-btn-${tarefaId}`);
    const timerElement = document.querySelector(`#timer-${tarefaId}`);

    if (startBtn && stopBtn) {
        startBtn.style.display = 'flex';
        stopBtn.style.display = 'none';
    }

    if (timerElement) {
        timerElement.textContent = `${horas}h ${minutos}m`;
    }
}

function handleBeforeUnload(event) {
		if (isTracking) {
				event.preventDefault();
				event.returnValue = 'Você ainda não parou a tarefa em andamento. Deseja sair mesmo assim?';
		}
}

window.startTracker = startTracker;
window.stopTracker = stopTracker;
window.concluirTarefa = concluirTarefa;

setInterval(() => {
		if (isTracking && currentTarefaId !== null) {
				fetch(`/painel/tarefas/${currentTarefaId}/check-status`)
						.then(response => response.json())
						.then(data => {
								if (!data.in_progress) {
										alert('A tarefa em andamento foi encerrada.');
										location.reload();
								}
						});
		}
}, 60000);

window.addEventListener('load', () => {
		const tarefas = document.querySelectorAll('[id^="timer-"]');
		tarefas.forEach(tarefa => {
				const tarefaId = tarefa.id.split('-')[1];
				fetch(`/painel/tarefas/${tarefaId}/check-status`)
						.then(response => response.json())
						.then(data => {
								if (data.in_progress) {
										const startTime = new Date(data.start_time + 'Z').getTime();
										const currentTime = Date.now();
										const elapsedTime = currentTime - startTime;

										timers[tarefaId] = {
												startTime: startTime,
												tempoUtilizadoHoras: parseInt(data.tempo_utilizado_horas) || 0,
												tempoUtilizadoMinutos: parseInt(data.tempo_utilizado_minutos) || 0,
												interval: setInterval(() => updateTimer(tarefaId), 1000)
										};

										isTracking = true;
										currentTarefaId = tarefaId;

										const startBtn = document.querySelector(`#start-btn-${tarefaId}`);
										const stopBtn = document.querySelector(`#stop-btn-${tarefaId}`);
										if (startBtn && stopBtn) {
												startBtn.style.display = 'none';
												stopBtn.style.display = 'flex';
										}
								}
						});
		});
});

function concluirTarefa(tarefaId) {
	const checkbox = document.getElementById(`tarefa-${tarefaId}`);
	const concluido = checkbox.checked ? 'true' : 'false';

	fetch(`/painel/tarefas/${tarefaId}/concluir`, {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
			'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
		},
		body: JSON.stringify({ status: concluido })
	})
	.then(response => response.json())
	.then(data => {
		if (data.status === 'success') {
			alert('Tarefa atualizada com sucesso!');
		} else {
			alert('Erro ao atualizar a tarefa.');
		}
	});
}