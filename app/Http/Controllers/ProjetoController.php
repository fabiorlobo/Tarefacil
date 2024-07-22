<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjetoController extends Controller
{
	public function index()
	{
		$projetos = Projeto::all();
		return view('painel.projetos.index', compact('projetos'));
	}

	public function create()
	{
		return view('painel.projetos.criar');
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'nome' => 'required|string|min:3|max:255',
			'descricao' => 'nullable|string|min:3|max:1000',
		]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		Projeto::create($request->all());

		return redirect()->route('projetos.index')->with('status', 'Projeto criado com sucesso!');
	}

	public function edit($id)
	{
		$projeto = Projeto::findOrFail($id);
		return view('painel.projetos.editar', compact('projeto'));
	}

	public function update(Request $request, $id)
	{
		$projeto = Projeto::findOrFail($id);

		$validator = Validator::make($request->all(), [
			'nome' => 'required|string|min:3|max:255',
			'descricao' => 'nullable|string|min:3|max:1000',
		]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$projeto->update($request->all());

		return redirect()->route('projetos.index')->with('status', 'Projeto atualizado com sucesso!');
	}

	public function destroy($id)
	{
		$projeto = Projeto::findOrFail($id);
		$projeto->delete();

		return redirect()->route('projetos.index')->with('status', 'Projeto excluído com sucesso!');
	}

	public function show($id)
	{
		$projeto = Projeto::findOrFail($id);
		return view('painel.projetos.show', compact('projeto'));
	}
}