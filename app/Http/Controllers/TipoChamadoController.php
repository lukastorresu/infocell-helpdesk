<?php

namespace App\Http\Controllers;

use App\Models\TipoChamado;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TipoChamadoController extends Controller
{
    public function index(): View
    {
        $tiposChamado = TipoChamado::orderBy('nome', 'asc')->paginate(10);
        
        return view('tipos_chamado.index', compact('tiposChamado'));
    }

    public function create(): View
    {
        return view('tipos_chamado.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nome' => 'required|string|max:100|unique:tipos_chamado,nome',
            'descricao' => 'nullable|string|max:100',
        ]);

        TipoChamado::create($request->all());

        return redirect()->route('tipos-chamado.index')
                         ->with('success', 'Tipo de chamado cadastrado com sucesso!');
    }

    public function edit(TipoChamado $tipos_chamado): View
    {
        return view('tipos_chamado.edit', ['tipoChamado' => $tipos_chamado]);
    }

    public function update(Request $request, TipoChamado $tipos_chamado): RedirectResponse
    {
        $request->validate([
            'nome' => 'required|string|max:100|unique:tipos_chamado,nome,' . $tipos_chamado->id,
            'descricao' => 'nullable|string|max:100',
        ]);

        $tipos_chamado->update($request->all());

        return redirect()->route('tipos-chamado.index')
                         ->with('success', 'Tipo de chamado atualizado com sucesso!');
    }

    public function destroy(TipoChamado $tipos_chamado): RedirectResponse
    {
        if ($tipos_chamado->chamados()->count() > 0) {
            return redirect()->route('tipos-chamado.index')
                             ->with('error', 'Este tipo de chamado não pode ser excluído pois está sendo utilizado.');
        }

        $tipos_chamado->delete();

        return redirect()->route('tipos-chamado.index')
                         ->with('success', 'Tipo de chamado excluído com sucesso!');
    }
}
