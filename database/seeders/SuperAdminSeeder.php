<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Projeto;
use App\Models\Lista;
use App\Models\Tarefa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
	public function run(): void
	{
		// Criar usuário SuperAdmin
		$user = User::updateOrCreate(
			['email' => 'suporte@wowf.com.br'],
			[
				'name' => 'Suporte WOWF',
				'password' => Hash::make('SuperAdmin2024'),
				'is_super_admin' => true
			]
		);

		// Criar projeto Tarefácil
		$projeto = Projeto::create([
			'nome' => 'Tarefácil',
			'user_id' => $user->id,
		]);

		// Criar lista Melhorias
		$lista = Lista::create([
			'nome' => 'Melhorias',
			'projeto_id' => $projeto->id,
			'user_id' => $user->id
		]);

		// Criar tarefas da lista Melhorias
		$tarefas = [
			['descricao' => 'Iniciar plano de divulgação', 'status' => false],
			['descricao' => 'Apagar usuários inativos', 'status' => false],
			['descricao' => 'Criar página de política de privacidade', 'status' => true],
			['descricao' => 'Testes com seeders', 'status' => true],
			['descricao' => 'Implementar blog', 'status' => false],
		];

		foreach ($tarefas as $tarefa) {
			Tarefa::create([
				'descricao' => $tarefa['descricao'],
				'lista_id' => $lista->id,
				'user_id' => $user->id,
				'status' => $tarefa['status']
			]);
		}
	}
}