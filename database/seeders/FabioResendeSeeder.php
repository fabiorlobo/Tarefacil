<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Projeto;
use App\Models\Lista;
use App\Models\Tarefa;
use App\Models\Nota;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FabioResendeSeeder extends Seeder
{
	public function run(): void
	{
		// Criar usuário Fabio Resende Lobo
		$user = User::updateOrCreate(
			['email' => 'fabiorlobo@gmail.com'],
			[
				'name' => 'Fabio Resende Lobo',
				'password' => Hash::make('Usuário2024')
			]
		);

		// Criar projetos
		$projetos = [
			'Projeto em branco' => null,
			'Estudos' => null,
			'Suporte - Cliente X' => 'Serviço de suporte e manutenção mensal',
		];

		foreach ($projetos as $nome => $descricao) {
			$projetos[$nome] = Projeto::create([
				'nome' => $nome,
				'descricao' => $descricao,
				'user_id' => $user->id
			]);
		}

		// Criar listas
		$listas = [
			'Lista em branco' => [
				'descricao' => null,
				'projeto_id' => null,
			],
			'TCC' => [
				'projeto' => 'Estudos',
				'descricao' => 'Projeto Integrado da PUC-MG para o curso de Desenvolvimento Web Full Stack'
			],
			'2024 - Agosto' => [
				'projeto' => 'Suporte - Cliente X',
				'tempo_previsto_horas' => 10
			],
			'2024 - Setembro' => [
				'projeto' => 'Suporte - Cliente X',
				'tempo_previsto_horas' => 10
			],
		];

		foreach ($listas as $nome => $detalhes) {
			Lista::create([
				'nome' => $nome,
				'descricao' => $detalhes['descricao'] ?? null,
				'projeto_id' => isset($detalhes['projeto']) ? $projetos[$detalhes['projeto']]->id : null,
				'user_id' => $user->id,
				'tempo_previsto_horas' => $detalhes['tempo_previsto_horas'] ?? null
			]);
		}

		// Criar tarefas da lista TCC com tempo utilizado
		$tarefasTCC = [
			['descricao' => 'Entregar TCC', 'tempo_utilizado_horas' => 5, 'tempo_utilizado_minutos' => 30, 'status' => true],
			['descricao' => 'Testar Tarefácil', 'tempo_utilizado_horas' => 3, 'tempo_utilizado_minutos' => 15, 'status' => true],
			['descricao' => 'Layout', 'tempo_utilizado_horas' => 6, 'tempo_utilizado_minutos' => 45, 'status' => true],
			['descricao' => 'Front-end', 'tempo_utilizado_horas' => 7, 'tempo_utilizado_minutos' => 0, 'status' => true],
			['descricao' => 'Back-end', 'tempo_utilizado_horas' => 4, 'tempo_utilizado_minutos' => 30, 'status' => true],
		];

		foreach ($tarefasTCC as $tarefa) {
			Tarefa::create([
				'descricao' => $tarefa['descricao'],
				'lista_id' => Lista::where('nome', 'TCC')->first()->id,
				'user_id' => $user->id,
				'status' => $tarefa['status'],
				'tempo_utilizado_horas' => $tarefa['tempo_utilizado_horas'],
				'tempo_utilizado_minutos' => $tarefa['tempo_utilizado_minutos'],
			]);
		}

		// Criar tarefas para 2024 - Agosto (com controle de tempo)
		$tarefasAgosto = [
			['descricao' => 'Aumentar o logo', 'tempo_previsto_horas' => 1, 'tempo_previsto_minutos' => 0, 'tempo_utilizado_horas' => 2, 'tempo_utilizado_minutos' => 0, 'status' => true],
			['descricao' => 'Atualização de plugins e WordPress', 'tempo_previsto_horas' => 2, 'tempo_previsto_minutos' => 0, 'tempo_utilizado_horas' => 2, 'tempo_utilizado_minutos' => 30, 'status' => true],
			['descricao' => 'Instalação do GA4', 'tempo_previsto_horas' => 3, 'tempo_previsto_minutos' => 0, 'tempo_utilizado_horas' => 3, 'tempo_utilizado_minutos' => 30, 'status' => true],
			['descricao' => 'Validação de erros do Search Console', 'tempo_previsto_horas' => 1, 'tempo_previsto_minutos' => 30, 'tempo_utilizado_horas' => 2, 'tempo_utilizado_minutos' => 0, 'status' => true],
			['descricao' => 'Atendimento por e-mail', 'tempo_previsto_horas' => 2, 'tempo_previsto_minutos' => 30, 'tempo_utilizado_horas' => 4, 'tempo_utilizado_minutos' => 0, 'status' => true],
		];

		foreach ($tarefasAgosto as $tarefa) {
			Tarefa::create([
				'descricao' => $tarefa['descricao'],
				'lista_id' => Lista::where('nome', '2024 - Agosto')->first()->id,
				'user_id' => $user->id,
				'status' => $tarefa['status'],
				'tempo_previsto_horas' => $tarefa['tempo_previsto_horas'],
				'tempo_previsto_minutos' => $tarefa['tempo_previsto_minutos'],
				'tempo_utilizado_horas' => $tarefa['tempo_utilizado_horas'],
				'tempo_utilizado_minutos' => $tarefa['tempo_utilizado_minutos'],
			]);
		}

		// Criar tarefas para 2024 - Setembro (com controle de tempo)
		$tarefasSetembro = [
			['descricao' => 'Atualização de plugins e WordPress', 'tempo_previsto_horas' => 1, 'tempo_previsto_minutos' => 0, 'tempo_utilizado_horas' => 1, 'tempo_utilizado_minutos' => 30, 'status' => false],
			['descricao' => 'Correção de bug no topo em smartphones', 'tempo_previsto_horas' => 2, 'tempo_previsto_minutos' => 0, 'tempo_utilizado_horas' => 2, 'tempo_utilizado_minutos' => 15, 'status' => true],
			['descricao' => 'Atendimento por e-mail', 'tempo_previsto_horas' => 2, 'tempo_previsto_minutos' => 30, 'tempo_utilizado_horas' => 3, 'tempo_utilizado_minutos' => 0, 'status' => false],
		];

		foreach ($tarefasSetembro as $tarefa) {
			Tarefa::create([
				'descricao' => $tarefa['descricao'],
				'lista_id' => Lista::where('nome', '2024 - Setembro')->first()->id,
				'user_id' => $user->id,
				'status' => $tarefa['status'],
				'tempo_previsto_horas' => $tarefa['tempo_previsto_horas'],
				'tempo_previsto_minutos' => $tarefa['tempo_previsto_minutos'],
				'tempo_utilizado_horas' => $tarefa['tempo_utilizado_horas'],
				'tempo_utilizado_minutos' => $tarefa['tempo_utilizado_minutos'],
			]);
		}

		// Criar anotações
		Nota::create([
			'nome' => 'Tarefa teste',
			'nota' => '<h1>Lorem Ipsum</h1>
<h2>Lorem ipsum dolor sit amet</h2>
<p><strong>Lorem ipsum dolor</strong> <em>sit amet</em>, consectetur adipiscing elit. 
Phasellus imperdiet, nulla et dictum interdum, nisi lorem egestas odio, vitae scelerisque enim ligula venenatis dolor.</p>
<p>Maecenas nisl est, <a href="http://tarefacil.wowf.com.br">tarefacil.wowf.com.br</a>, 
ultrices nec congue eget, auctor vitae massa. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ut placerat orci nulla pellentesque dignissim enim sit amet venenatis.</p>
<h3>Sed do eiusmod tempor</h3>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>',
			'projeto_id' => null,
			'user_id' => $user->id,
		]);

		Nota::create([
			'nome' => 'Dados do Cliente X',
			'nota' => '<p>Cloudflare: user@cloudflare.com, senha: senha123</p><p>CPanel: user@cpanel.com, senha: senha456...</p>',
			'projeto_id' => $projetos['Suporte - Cliente X']->id,
			'user_id' => $user->id,
		]);
	}
}