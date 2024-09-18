<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Lista extends Model
{
	use HasFactory;

	protected $fillable = [
		'nome',
		'descricao',
		'projeto_id',
		'user_id',
		'tempo_previsto_horas',
		'tempo_previsto_minutos',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function tarefas()
	{
		return $this->hasMany(Tarefa::class);
	}

	public function projeto()
	{
		return $this->belongsTo(Projeto::class);
	}

	public function tempoTrabalhado()
	{
		$horas = $this->tarefas->sum('tempo_utilizado_horas');
		$minutos = $this->tarefas->sum('tempo_utilizado_minutos');
		$totalMinutos = $horas * 60 + $minutos;

		return ['horas' => intdiv($totalMinutos, 60), 'minutos' => $totalMinutos % 60];
	}

	public function tempoRestante()
	{
		$horasPrevistas = $this->tempo_previsto_horas ?? 0;
		$minutosPrevistos = $this->tempo_previsto_minutos ?? 0;
		$totalPrevistos = $horasPrevistas * 60 + $minutosPrevistos;

		$trabalhado = $this->tempoTrabalhado();
		$totalTrabalhado = $trabalhado['horas'] * 60 + $trabalhado['minutos'];

		$restante = $totalPrevistos - $totalTrabalhado;
		return $restante > 0 ? ['horas' => intdiv($restante, 60), 'minutos' => $restante % 60] : null;
	}
}