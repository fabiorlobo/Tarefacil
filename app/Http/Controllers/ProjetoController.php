<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use App\Models\Lista;
use App\Models\Nota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjetoController extends Controller
{
	public function painel()
	{
		$userId = auth()->id();
		$projetos = Projeto::where('user_id', $userId)->with(['listas.tarefas'])->get();
		$listas = Lista::where('user_id', $userId)->with('tarefas')->get();
		$notas = Nota::where('user_id', $userId)->get();

		return view('painel', compact('projetos', 'listas', 'notas'));
	}

	public function index()
	{
		$userId = auth()->id();
		$projetos = Projeto::where('user_id', $userId)->get();

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

		$projeto = Projeto::create(array_merge($request->all(), ['user_id' => auth()->id()]));

		return redirect()->route('projetos.show', $projeto->id)->with('status', 'Projeto criado com sucesso!');
	}

	public function edit($id)
	{
		$userId = auth()->id();
		$projeto = Projeto::where('id', $id)->where('user_id', $userId)->firstOrFail();
		return view('painel.projetos.editar', compact('projeto'));
	}

	public function update(Request $request, $id)
	{
		$userId = auth()->id();
		$projeto = Projeto::where('id', $id)->where('user_id', $userId)->firstOrFail();

		$validator = Validator::make($request->all(), [
			'nome' => 'required|string|min:3|max:255',
			'descricao' => 'nullable|string|min:3|max:1000',
		]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$projeto->update($request->all());

		return redirect()->route('projetos.show', $projeto->id)->with('status', 'Projeto atualizado com sucesso!');
	}

	public function destroy($id)
	{
		$projeto = Projeto::findOrFail($id);
		$projeto->delete();

		return redirect()->route('projetos.index')->with('status', 'Projeto excluído com sucesso!');
	}

	public function show($id)
	{
		$userId = auth()->id();
		$projeto = Projeto::where('id', $id)
			->where('user_id', $userId)
			->with(['listas.tarefas', 'notas'])
			->firstOrFail();

		return view('painel.projetos.show', compact('projeto'));
	}

}