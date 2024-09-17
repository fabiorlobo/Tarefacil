<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetosTable extends Migration
{
	public function up()
	{
		Schema::create('projetos', function (Blueprint $table) {
			$table->id();
			$table->string('nome', 255);
			$table->text('descricao')->nullable();
			$table->foreignId('user_id')->constrained('users')->onDelete('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('projetos');
	}
}