<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use App\Models\Lista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TarefaController extends Controller
{
	public function create($listaId = null)
	{
		$listas = Lista::all();
		return view('painel.tarefas.criar', compact('listas', 'listaId'));
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'descricao' => 'required|string|min:3|max:1000',
			'lista_id' => 'required|string',
			'tempo_previsto_horas' => 'nullable|integer|min:0|max:23',
			'tempo_previsto_minutos' => 'nullable|integer|min:0|max:59',
			'tempo_utilizado_horas' => 'nullable|integer|min:0|max:23',
			'tempo_utilizado_minutos' => 'nullable|integer|min:0|max:59',
		]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		if ($request->filled('lista_id') && !is_numeric($request->lista_id)) {
			$lista = Lista::create(['nome' => $request->lista_id]);
			$request->merge(['lista_id' => $lista->id]);
		}

		Tarefa::create($request->all());

		return redirect()->route('listas.show', $request->lista_id)->with('status', 'Tarefa criada com sucesso!');
	}

	public function edit($id)
	{
		$tarefa = Tarefa::findOrFail($id);
		$listas = Lista::all();
		return view('painel.tarefas.editar', compact('tarefa', 'listas'));
	}

	public function update(Request $request, $id)
	{
		$tarefa = Tarefa::findOrFail($id);

		$validator = Validator::make($request->all(), [
			'descricao' => 'required|string|min:3|max:1000',
			'lista_id' => 'required|string',
			'tempo_previsto_horas' => 'nullable|integer|min:0|max:23',
			'tempo_previsto_minutos' => 'nullable|integer|min:0|max:59',
			'tempo_utilizado_horas' => 'nullable|integer|min:0|max:23',
			'tempo_utilizado_minutos' => 'nullable|integer|min:0|max:59',
		]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		if ($request->filled('lista_id') && !is_numeric($request->lista_id)) {
			$lista = Lista::create(['nome' => $request->lista_id]);
			$request->merge(['lista_id' => $lista->id]);
		}

		$tarefa->update($request->all());

		return redirect()->route('listas.show', $tarefa->lista_id)->with('status', 'Tarefa atualizada com sucesso!');
	}

	public function startTracker($id)
	{
		$tarefa = Tarefa::findOrFail($id);
		$tarefa->in_progress = true;
		$tarefa->start_time = now(); // Garantir que o horário é salvo em UTC
		$tarefa->save();

		return response()->json(['status' => 'success', 'start_time' => $tarefa->start_time->format('Y-m-d H:i:s')]);
	}

	public function stopTracker(Request $request, $id)
	{
		$tarefa = Tarefa::findOrFail($id);
		$tarefa->in_progress = false;

		$elapsedTime = $request->input('elapsedTime', 0);
		if ($elapsedTime > 0) {
			$hours = floor($elapsedTime / 3600);
			$minutes = floor(($elapsedTime % 3600) / 60);

			$tarefa->tempo_utilizado_horas += $hours;
			$tarefa->tempo_utilizado_minutos += $minutes;

			if ($tarefa->tempo_utilizado_minutos >= 60) {
				$tarefa->tempo_utilizado_horas += floor($tarefa->tempo_utilizado_minutos / 60);
				$tarefa->tempo_utilizado_minutos = $tarefa->tempo_utilizado_minutos % 60;
			}
		}

		$tarefa->start_time = null;
		$tarefa->save();

		return response()->json([
			'status' => 'success',
			'tempo_utilizado_horas' => $tarefa->tempo_utilizado_horas,
			'tempo_utilizado_minutos' => $tarefa->tempo_utilizado_minutos
		]);
	}

	public function checkStatus($id)
	{
		$tarefa = Tarefa::findOrFail($id);
		return response()->json([
			'in_progress' => $tarefa->in_progress,
			'start_time' => $tarefa->start_time,
		]);
	}

	public function destroy($id)
	{
		$tarefa = Tarefa::findOrFail($id);
		$tarefa->delete();

		return redirect()->route('listas.show', $tarefa->lista_id)->with('status', 'Tarefa excluída com sucesso!');
	}

	public function concluir(Request $request, $id)
	{
		$tarefa = Tarefa::findOrFail($id);

		$tarefa->status = filter_var($request->input('status'), FILTER_VALIDATE_BOOLEAN);
		$tarefa->save();

		return response()->json(['status' => 'success']);
	}


}