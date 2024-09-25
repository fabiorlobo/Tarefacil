<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Projeto;
use App\Models\Lista;
use App\Models\Tarefa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class JanioSarmentoSeeder extends Seeder
{
	public function run(): void
	{
		// Criar usuário Janio Sarmento
		$user = User::updateOrCreate(
			['email' => 'sarmento@gmail.com'],
			[
				'name' => 'Janio Sarmento',
				'password' => Hash::make('JanioSarmento2024')
			]
		);

		// Criar projetos PKP e PortoFácil
		$projetos = [
			'PKP' => Projeto::create(['nome' => 'PKP', 'user_id' => $user->id]),
			'PortoFácil' => Projeto::create(['nome' => 'PortoFácil', 'user_id' => $user->id])
		];

		// Criar lista PKP - September 2024 com tempo estimado de 120 horas
		$listaPKP = Lista::create([
			'nome' => 'PKP - September 2024',
			'projeto_id' => $projetos['PKP']->id,
			'user_id' => $user->id,
			'tempo_previsto_horas' => 120
		]);

		// Criar tarefas para PKP - September 2024 (totalizando 120 horas)
		$tarefasPKP = [
			['descricao' => 'Configurar backups diários', 'tempo_utilizado_horas' => 10],
			['descricao' => 'Monitorar servidor', 'tempo_utilizado_horas' => 15],
			['descricao' => 'Atualizar sistema de segurança', 'tempo_utilizado_horas' => 12],
			['descricao' => 'Auditar logs do servidor', 'tempo_utilizado_horas' => 8],
			['descricao' => 'Ajustar permissões de arquivos', 'tempo_utilizado_horas' => 10],
			['descricao' => 'Monitorar uso de disco', 'tempo_utilizado_horas' => 9],
			['descricao' => 'Monitorar CPU', 'tempo_utilizado_horas' => 7],
			['descricao' => 'Testar escalabilidade do sistema', 'tempo_utilizado_horas' => 11],
			['descricao' => 'Revisar plano de recuperação', 'tempo_utilizado_horas' => 9],
			['descricao' => 'Atualizar software de gerenciamento', 'tempo_utilizado_horas' => 10],
			['descricao' => 'Revisar performance de banco de dados', 'tempo_utilizado_horas' => 9],
			['descricao' => 'Auditar acesso SSH', 'tempo_utilizado_horas' => 5],
			['descricao' => 'Revisar alertas de segurança', 'tempo_utilizado_horas' => 5],
		];

		foreach ($tarefasPKP as $tarefa) {
			Tarefa::create([
				'descricao' => $tarefa['descricao'],
				'lista_id' => $listaPKP->id,
				'user_id' => $user->id,
				'tempo_utilizado_horas' => $tarefa['tempo_utilizado_horas'],
				'status' => true
			]);
		}

		// Criar lista Clientes no projeto PortoFácil
		$listaClientes = Lista::create([
			'nome' => 'Clientes',
			'projeto_id' => $projetos['PortoFácil']->id,
			'user_id' => $user->id
		]);

		// Criar tarefas para a lista Clientes (13 tarefas relacionadas a cuidados com clientes)
		$tarefasClientes = [
			['descricao' => 'Configurar VPS para novo cliente', 'tempo_utilizado_horas' => 5, 'status' => true],
			['descricao' => 'Atualizar sistema operacional em servidores de clientes', 'tempo_utilizado_horas' => 4, 'status' => false],
			['descricao' => 'Instalar painel de controle solicitado por cliente', 'tempo_utilizado_horas' => 3, 'status' => true],
			['descricao' => 'Ajustar segurança no servidor do cliente', 'tempo_utilizado_horas' => 2, 'status' => true],
			['descricao' => 'Monitorar tráfego de rede para cliente X', 'tempo_utilizado_horas' => 6, 'status' => false],
			['descricao' => 'Fazer backup do servidor de cliente Y', 'tempo_utilizado_horas' => 3, 'status' => true],
			['descricao' => 'Analisar logs do servidor de cliente Z', 'tempo_utilizado_horas' => 4, 'status' => true],
			['descricao' => 'Resolver problema de DNS de cliente X', 'tempo_utilizado_horas' => 2, 'status' => true],
			['descricao' => 'Aumentar capacidade de armazenamento para cliente Y', 'tempo_utilizado_horas' => 7, 'status' => true],
			['descricao' => 'Instalar SSL para cliente Z', 'tempo_utilizado_horas' => 1, 'status' => true],
			['descricao' => 'Verificar integridade de backups para cliente X', 'tempo_utilizado_horas' => 4, 'status' => false],
			['descricao' => 'Atendimento de suporte técnico para cliente Y', 'tempo_utilizado_horas' => 5, 'status' => true],
			['descricao' => 'Auditar segurança do servidor de cliente Z', 'tempo_utilizado_horas' => 6, 'status' => true],
		];

		foreach ($tarefasClientes as $tarefa) {
			Tarefa::create([
				'descricao' => $tarefa['descricao'],
				'lista_id' => $listaClientes->id,
				'user_id' => $user->id,
				'tempo_utilizado_horas' => $tarefa['tempo_utilizado_horas'],
				'status' => $tarefa['status']
			]);
		}
	}
}