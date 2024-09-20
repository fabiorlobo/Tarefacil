<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
	public function viewAny(User $user)
	{
		return $user->is_super_admin;
	}

	public function update(User $user)
	{
		return $user->is_super_admin;
	}

	public function delete(User $user)
	{
		return $user->is_super_admin;
	}
}