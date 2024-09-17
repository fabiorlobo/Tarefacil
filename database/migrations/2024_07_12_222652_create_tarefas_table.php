<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarefasTable extends Migration
{
	public function up()
	{
		Schema::create('tarefas', function (Blueprint $table) {
			$table->id();
			$table->text('descricao');
			$table->foreignId('lista_id')->constrained()->onDelete('cascade');
			$table->integer('tempo_previsto_horas')->nullable();
			$table->integer('tempo_previsto_minutos')->nullable();
			$table->integer('tempo_utilizado_horas')->nullable();
			$table->integer('tempo_utilizado_minutos')->nullable();
			$table->boolean('status')->default(false);
			$table->foreignId('user_id')->constrained('users')->onDelete('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('tarefas');
	}
}