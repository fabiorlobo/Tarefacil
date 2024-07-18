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
			$table->string('nome');
			$table->text('descricao')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('projetos');
	}
}