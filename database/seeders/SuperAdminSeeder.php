<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
	public function run(): void
	{
		$user = User::where('email', 'contato@fabiolobo.com.br')->first();
		if ($user) {
			$user->is_super_admin = true;
			$user->save();
		}
	}
}