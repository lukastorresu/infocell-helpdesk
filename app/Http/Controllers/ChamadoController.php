<?php

namespace App\Http\Controllers;

use App\Models\Chamado;
use App\Models\Cliente;
use App\Models\User;
use App\Models\TipoChamado;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Barryvdh\DomPDF\Facade\Pdf;

class ChamadoController extends Controller
{
public function index(Request $request): View
    {
        // Pega os valores dos filtros da requisição
        $searchCliente = $request->input('search_cliente');
        $searchTipo = $request->input('search_tipo');
        $searchStatus = $request->input('search_status');
        $searchDateStart = $request->input('search_date_start');
        $searchDateEnd = $request->input('search_date_end');
        $searchTecnico = $request->input('search_tecnico');
        $searchPagamento = $request->input('search_pagamento');

        $chamados = Chamado::with(['cliente', 'tecnico', 'tipoChamado'])
            ->when($searchCliente, function ($query, $cliente) {
                $query->whereHas('cliente', function ($q) use ($cliente) {
                    $q->where('nome', 'like', "%{$cliente}%");
                });
            })
            ->when($searchTipo, function ($query, $tipoId) {
                $query->where('tipo_id', $tipoId);
            })
            ->when($searchTecnico, function ($query, $tecnicoId) {
                $query->where('user_id', $tecnicoId);
            })
            ->when($searchStatus !== null && $searchStatus !== '', function ($query) use ($searchStatus) {
                $query->where('status', $searchStatus);
            })
            // NOVO: Filtro da forma de pagamento
            ->when($searchPagamento !== null && $searchPagamento !== '', function ($query) use ($searchPagamento) {
                $query->where('forma_pagamento', $searchPagamento);
            })
            ->when($searchDateStart, function ($query, $date) {
                $query->whereDate('created_at', '>=', $date);
            })
            ->when($searchDateEnd, function ($query, $date) {
                $query->whereDate('created_at', '<=', $date);
            })
            ->latest()
            ->paginate(10);

        $tiposChamado = TipoChamado::orderBy('nome')->get();
        $tecnicos = User::orderBy('nome')->get();

        return view('chamados.index', compact('chamados', 'tiposChamado', 'tecnicos'));
    }

    public function create(): View
    {
        $clientes = Cliente::orderBy('nome')->get();

        $tecnicos = User::orderBy('nome')->get();

        $tiposChamado = TipoChamado::orderBy('nome')->get();
        return view('chamados.create', compact('clientes', 'tecnicos', 'tiposChamado'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'tecnico_id' => 'required|exists:users,id',
            'tipo_id' => 'required|exists:tipos_chamado,id',
            'descricao' => 'required|string',
            'forma_pagamento' => 'nullable|in:Pix,Cartão,Dinheiro',
        ]);

        $dados = $request->all();
        $dados['user_id'] = $dados['tecnico_id'];
        unset($dados['tecnico_id']);

        Chamado::create($dados);
        return redirect()->route('chamados.index')->with('success', 'Chamado aberto com sucesso!');
    }

    public function show(Chamado $chamado): View
    {
        $chamado->load(['cliente', 'tecnico', 'tipoChamado']);
        return view('chamados.show', compact('chamado'));
    }

    public function edit(Chamado $chamado): View
    {
        $clientes = Cliente::orderBy('nome')->get();

        $tecnicos = User::orderBy('nome')->get();

        $tiposChamado = TipoChamado::orderBy('nome')->get();
        return view('chamados.edit', compact('chamado', 'clientes', 'tecnicos', 'tiposChamado'));
    }

    public function update(Request $request, Chamado $chamado): RedirectResponse
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'tecnico_id' => 'required|exists:users,id',
            'tipo_id' => 'required|exists:tipos_chamado,id',
            'descricao' => 'required|string',
            'status' => 'required|in:aberto,cancelado,concluido',
            'valor_total' => 'required_if:status,concluido|nullable|regex:/^\d{1,8}(,\d{2})?$/',
            'forma_pagamento' => 'required_if:status,concluido|nullable|in:Pix,Cartão,Dinheiro',
        ], [
            'valor_total.required_if' => 'O campo valor total é obrigatório ao concluir um chamado.',
            'valor_total.regex' => 'O valor total deve estar no formato XXXX,XX.',
            'status.in' => 'O status selecionado é inválido.',
            // NOVO: Mensagem de erro customizada
            'forma_pagamento.required_if' => 'A forma de pagamento é obrigatória ao concluir um chamado.',
            'forma_pagamento.in' => 'A forma de pagamento selecionada é inválida.'
        ]);

        $dados = $request->all();

        $dados['user_id'] = $dados['tecnico_id'];
        unset($dados['tecnico_id']);

        if ($request->filled('valor_total')) {
            $dados['valor_total'] = str_replace(',', '.', str_replace('.', '', $request->valor_total));
        } else {
            $dados['valor_total'] = null;
        }

        $chamado->update($dados);

        return redirect()->route('chamados.index')->with('success', 'Chamado atualizado com sucesso!');
    }

    public function destroy(Chamado $chamado): RedirectResponse
    {
        $chamado->delete();
        return redirect()->route('chamados.index')->with('success', 'Chamado excluído com sucesso!');
    }

    public function generatePDF(Chamado $chamado)
    {
        $chamado->load(['cliente', 'tecnico', 'tipoChamado']);
        $pdf = Pdf::loadView('chamados.pdf', compact('chamado'));
        return $pdf->stream('ordem_servico_' . $chamado->id . '.pdf');
    }
}
