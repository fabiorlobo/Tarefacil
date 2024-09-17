<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListasTable extends Migration
{
	public function up()
	{
		if (!Schema::hasTable('listas')) {
			Schema::create('listas', function (Blueprint $table) {
				$table->id();
				$table->foreignId('user_id')->constrained('users')->onDelete('cascade');
				$table->string('nome');
				$table->text('descricao')->nullable();
				$table->foreignId('projeto_id')->nullable()->constrained('projetos')->onDelete('cascade');
				$table->integer('tempo_previsto_horas')->nullable();
				$table->integer('tempo_previsto_minutos')->nullable();
				$table->timestamps();
			});
		}
	}

	public function down()
	{
		Schema::dropIfExists('listas');
	}
}