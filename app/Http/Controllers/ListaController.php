<?php

namespace App\Http\Controllers;

use App\Models\Lista;
use App\Models\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

	public function create(Request $request)
	{
		$userId = auth()->id();
		$projetos = Projeto::where('user_id', $userId)->get();
		$projetoIdSelecionado = $request->input('projeto_id');
		return view('painel.listas.criar', compact('projetos', 'projetoIdSelecionado'));
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'nome' => 'required|string|min:3|max:255',
			'descricao' => 'nullable|string|max:1000',
			'projeto_id' => 'nullable|string',
			'tempo_previsto_horas' => 'nullable|integer|min:0',
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

		$lista = Lista::create($data);

		return redirect()->route('listas.show', $lista->id)->with('status', 'Lista criada com sucesso!');
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
			'tempo_previsto_horas' => 'nullable|integer|min:0',
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

		return redirect()->route('listas.show', $lista->id)->with('status', 'Lista atualizada com sucesso!');
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

	public function resumo($id)
	{
		$lista = Lista::with('tarefas')->findOrFail($id);

		$tempoTrabalhadoHoras = $lista->tarefas->sum('tempo_utilizado_horas');
		$tempoTrabalhadoMinutos = $lista->tarefas->sum('tempo_utilizado_minutos');
		$totalTrabalhadoMinutos = $tempoTrabalhadoHoras * 60 + $tempoTrabalhadoMinutos;
		$totalPrevistoMinutos = ($lista->tempo_previsto_horas ?? 0) * 60 + ($lista->tempo_previsto_minutos ?? 0);
		$tempoRestanteMinutos = $totalPrevistoMinutos - $totalTrabalhadoMinutos;
		$tempoExcedidoMinutos = $totalTrabalhadoMinutos > $totalPrevistoMinutos ? $totalTrabalhadoMinutos - $totalPrevistoMinutos : 0;

		$totalTarefas = $lista->tarefas->count();
		$tarefasConcluidas = $lista->tarefas->where('status', true)->count();
		$tarefasPendentes = $totalTarefas - $tarefasConcluidas;

		return response()->json([
			'tempoReservadoHoras' => $lista->tempo_previsto_horas ?? 0,
			'tempoReservadoMinutos' => $lista->tempo_previsto_minutos ?? 0,
			'tempoTrabalhadoHoras' => intdiv($totalTrabalhadoMinutos, 60),
			'tempoTrabalhadoMinutos' => $totalTrabalhadoMinutos % 60,
			'tempoRestanteHoras' => intdiv($tempoRestanteMinutos, 60),
			'tempoRestanteMinutos' => $tempoRestanteMinutos % 60,
			'tempoExcedidoHoras' => intdiv($tempoExcedidoMinutos, 60),
			'tempoExcedidoMinutos' => $tempoExcedidoMinutos % 60,
			'totalTarefas' => $totalTarefas,
			'tarefasConcluidas' => $tarefasConcluidas,
			'tarefasPendentes' => $tarefasPendentes
		]);
	}

	public function downloadReport($id)
	{
		$lista = Lista::with('tarefas')->findOrFail($id);

		$tempoTrabalhadoHoras = $lista->tarefas->sum('tempo_utilizado_horas');
		$tempoTrabalhadoMinutos = $lista->tarefas->sum('tempo_utilizado_minutos');
		$totalTrabalhadoMinutos = $tempoTrabalhadoHoras * 60 + $tempoTrabalhadoMinutos;

		$totalPrevistoMinutos = ($lista->tempo_previsto_horas ?? 0) * 60 + ($lista->tempo_previsto_minutos ?? 0);

		$tempoRestanteMinutos = $totalPrevistoMinutos - $totalTrabalhadoMinutos;

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$sheet->mergeCells('A1:B1');
		$sheet->setCellValue('A1', $lista->nome)->getStyle('A1')->getFont()->setBold(true);
		$sheet->getStyle('A1:B1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FCFCFC');

		$sheet->setCellValue('A2', '');

		$sheet->setCellValue('A3', 'Tarefa')->getStyle('A3')->getFont()->setBold(true);
		$sheet->setCellValue('B3', 'Tempo trabalhado')->getStyle('B3')->getFont()->setBold(true);

		$sheet->getColumnDimension('A')->setAutoSize(true);
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->getStyle('A')->getAlignment()->setWrapText(true);
		$sheet->getStyle('B')->getAlignment()->setWrapText(true);

		$row = 4;
		foreach ($lista->tarefas as $tarefa) {
			$tempoTrabalhado = ($tarefa->tempo_utilizado_horas ?? 0) . 'h ' . ($tarefa->tempo_utilizado_minutos ?? 0) . 'm';
			$sheet->setCellValue('A' . $row, $tarefa->descricao);
			$sheet->setCellValue('B' . $row, $tempoTrabalhado);
			$row++;
		}

		$sheet->setCellValue('A' . ++$row, '');
		$sheet->setCellValue('A' . ++$row, 'Tempo trabalhado total:')->getStyle('A' . $row)->getFont()->setBold(true);
		$sheet->setCellValue('B' . $row, intdiv($totalTrabalhadoMinutos, 60) . 'h ' . $totalTrabalhadoMinutos % 60 . 'm');

		$sheet->setCellValue('A' . ++$row, 'Tempo reservado:')->getStyle('A' . $row)->getFont()->setBold(true);
		$sheet->setCellValue('B' . $row, intdiv($totalPrevistoMinutos, 60) . 'h ' . $totalPrevistoMinutos % 60 . 'm');

		$sheet->setCellValue('A' . ++$row, 'Total:')->getStyle('A' . $row)->getFont()->setBold(true);
		$sheet->setCellValue('B' . $row, intdiv($tempoRestanteMinutos, 60) . 'h ' . $tempoRestanteMinutos % 60 . 'm');

		$writer = new Xlsx($spreadsheet);
		$filename = str_replace(' ', '_', $lista->nome) . '.xlsx';

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="' . urlencode($filename) . '"');
		$writer->save('php://output');
		exit;
	}
}