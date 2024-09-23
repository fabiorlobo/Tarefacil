<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
	public function run(): void
	{
		$user = User::updateOrCreate(
			['email' => 'suporte@wowf.com.br'],
			[
				'name' => 'WOWF',
				'password' => Hash::make('PUC-mg2024'),
				'is_super_admin' => true
			]
		);
	}
}