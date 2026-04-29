<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $query = Cliente::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nome', 'like', '%' . $request->search . '%');
        }

        $clientes = $query->orderBy('nome', 'asc')->paginate(10);

        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:100',
            'endereco' => 'required|string|max:200',
            'telefone' => 'required|string|max:20',
            'email' => 'nullable|email|max:100',
        ]);

        Cliente::create($validatedData);

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function show(Cliente $cliente)
    {
        $cliente->load('chamados.tipoChamado');
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:100',
            'endereco' => 'required|string|max:200',
            'telefone' => 'required|string|max:20',
            'email' => 'nullable|email|max:100',
        ]);

        $cliente->fill($validatedData);
        $cliente->mal_pagador = $request->has('mal_pagador');
        $cliente->save();

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente excluído com sucesso!');
    }

    public function search(Request $request)
    {
        $search = $request->input('q');
        $clients = Cliente::where('nome', 'LIKE', "%{$search}%")
            ->orWhere('id', 'LIKE', "%{$search}%")
            ->limit(10)
            ->get(['id', 'nome as text']);

        return response()->json($clients);
    }
}
