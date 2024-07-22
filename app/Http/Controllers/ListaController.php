<?php

namespace App\Http\Controllers;

use App\Models\Lista;
use App\Models\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ListaController extends Controller
{
	public function index()
	{
		$listas = Lista::all();
		return view('painel.listas.index', compact('listas'));
	}

	public function create()
	{
		$projetos = Projeto::all();
		return view('painel.listas.criar', compact('projetos'));
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'nome' => 'required|string|min:3|max:255',
			'descricao' => 'nullable|string|max:1000',
			'projeto_id' => 'nullable|string',
			'tempo_previsto_horas' => 'nullable|integer|min:0|max:23',
			'tempo_previsto_minutos' => 'nullable|integer|min:0|max:59',
		]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		if ($request->filled('projeto_id') && !is_numeric($request->projeto_id)) {
			$projeto = Projeto::create(['nome' => $request->projeto_id]);
			$request->merge(['projeto_id' => $projeto->id]);
		}

		Lista::create($request->all());

		return redirect()->route('listas.index')->with('status', 'Lista criada com sucesso!');
	}

	public function edit($id)
	{
		$lista = Lista::findOrFail($id);
		$projetos = Projeto::all();
		return view('painel.listas.editar', compact('lista', 'projetos'));
	}

	public function update(Request $request, $id)
	{
		$lista = Lista::findOrFail($id);

		$validator = Validator::make($request->all(), [
			'nome' => 'required|string|min:3|max:255',
			'descricao' => 'nullable|string|max:1000',
			'projeto_id' => 'nullable|string',
			'tempo_previsto_horas' => 'nullable|integer|min:0|max:23',
			'tempo_previsto_minutos' => 'nullable|integer|min:0|max:59',
		]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		if ($request->filled('projeto_id') && !is_numeric($request->projeto_id)) {
			$projeto = Projeto::create(['nome' => $request->projeto_id]);
			$request->merge(['projeto_id' => $projeto->id]);
		}

		$lista->update($request->all());

		return redirect()->route('listas.index')->with('status', 'Lista atualizada com sucesso!');
	}

	public function show($id)
	{
		$lista = Lista::with('tarefas')->findOrFail($id);
		return view('painel.listas.show', compact('lista'));
	}

	public function destroy($id)
	{
		$lista = Lista::findOrFail($id);
		$lista->delete();

		return redirect()->route('listas.index')->with('status', 'Lista excluída com sucesso!');
	}
}