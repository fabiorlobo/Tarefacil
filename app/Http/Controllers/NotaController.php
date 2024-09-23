<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotaController extends Controller
{
	public function index()
	{
		$userId = auth()->id();
		$notas = Nota::where('user_id', $userId)->with('projeto')->get();
		return view('painel.notas.index', compact('notas'));
	}

	public function create(Request $request)
	{
		$userId = auth()->id();
		$projetos = Projeto::where('user_id', $userId)->get();
		$projetoIdSelecionado = $request->input('projeto_id');
		return view('painel.notas.criar', compact('projetos', 'projetoIdSelecionado'));
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'nome' => 'required|string|min:3|max:255',
			'descricao' => 'nullable|string|max:1000',
			'nota' => 'required|string|min:3|max:5000',
			'projeto_id' => 'nullable|string',
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

		$nota = Nota::create($data);

		return redirect()->route('notas.show', $nota->id)->with('status', 'Anotação criada com sucesso!');
	}

	public function edit($id)
	{
		$userId = auth()->id();
		$nota = Nota::where('id', $id)->where('user_id', $userId)->firstOrFail();
		$projetos = Projeto::where('user_id', $userId)->get();
		return view('painel.notas.editar', compact('nota', 'projetos'));
	}

	public function update(Request $request, $id)
	{
		$userId = auth()->id();
		$nota = Nota::where('id', $id)->where('user_id', $userId)->firstOrFail();

		$validator = Validator::make($request->all(), [
			'nome' => 'required|string|min:3|max:255',
			'descricao' => 'nullable|string|max:1000',
			'nota' => 'required|string|min:3|max:5000',
			'projeto_id' => 'nullable|string',
		]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$data = $request->all();

		if ($request->filled('projeto_id') && !is_numeric($request->projeto_id)) {
			$projeto = Projeto::create(['nome' => $request->projeto_id, 'user_id' => $userId]);
			$data['projeto_id'] = $projeto->id;
		}

		$nota->update($data);

		return redirect()->route('notas.show', $nota->id)->with('status', 'Anotação atualizada com sucesso!');
	}

	public function destroy($id)
	{
		$userId = auth()->id();
		$nota = Nota::where('id', $id)->where('user_id', $userId)->firstOrFail();
		$nota->delete();

		return redirect()->route('notas.index')->with('status', 'Anotação excluída com sucesso!');
	}

	public function show($id)
	{
		$userId = auth()->id();
		$nota = Nota::where('id', $id)->where('user_id', $userId)->with('projeto')->firstOrFail();
		return view('painel.notas.show', compact('nota'));
	}
}