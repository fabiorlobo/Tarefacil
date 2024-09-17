<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
	protected $policies = [
		User::class => 'App\Policies\UserPolicy',
	];

	public function boot(): void
	{
		$this->registerPolicies();

		Gate::define('manage-users', function ($user) {
			return $user->is_super_admin;
		});
	}
}