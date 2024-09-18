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
		$userId = auth()->id();
		$listas = Lista::where('user_id', $userId)->with('tarefas')->get();
		return view('painel.listas.index', compact('listas'));
	}

	public function getUserLists()
	{
		$userId = auth()->id();
		$listas = Lista::where('user_id', $userId)->with('tarefas')->get();
		return $listas;
	}

	public function create()
	{
		$userId = auth()->id();
		$projetos = Projeto::where('user_id', $userId)->get();
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

		$data = $request->all();
		$data['user_id'] = auth()->id();

		if ($request->filled('projeto_id') && !is_numeric($request->projeto_id)) {
			$projeto = Projeto::create(['nome' => $request->projeto_id, 'user_id' => auth()->id()]);
			$data['projeto_id'] = $projeto->id;
		}

		Lista::create($data);

		return redirect()->route('listas.index')->with('status', 'Lista criada com sucesso!');
	}

	public function edit($id)
	{
		$userId = auth()->id();
		$lista = Lista::where('id', $id)->where('user_id', $userId)->firstOrFail();
		$projetos = Projeto::where('user_id', $userId)->get();
		return view('painel.listas.editar', compact('lista', 'projetos'));
	}

	public function update(Request $request, $id)
	{
		$userId = auth()->id();
		$lista = Lista::where('id', $id)->where('user_id', $userId)->firstOrFail();

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

		$data = $request->all();
		$data['user_id'] = $userId;
		if ($request->filled('projeto_id') && !is_numeric($request->projeto_id)) {
			$projeto = Projeto::create(['nome' => $request->projeto_id, 'user_id' => $userId]);
			$data['projeto_id'] = $projeto->id;
		}

		$lista->update($data);

		return redirect()->route('listas.index')->with('status', 'Lista atualizada com sucesso!');
	}

	public function show($id)
	{
		$userId = auth()->id();
		$lista = Lista::where('id', $id)->where('user_id', $userId)->with('tarefas')->firstOrFail();
		return view('painel.listas.show', compact('lista'));
	}

	public function destroy($id)
	{
		$userId = auth()->id();
		$lista = Lista::where('id', $id)->where('user_id', $userId)->firstOrFail();
		$lista->delete();

		return redirect()->route('listas.index')->with('status', 'Lista excluída com sucesso!');
	}
}