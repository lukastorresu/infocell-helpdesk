<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Chamado;
use App\Models\TipoChamado;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(): View
    {
        $hoje = Carbon::today()->toDateString();
        
        // Define o início para segunda-feira e o fim para sábado (+5 dias)
        $inicioSemana = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $fimSemana = Carbon::now()->startOfWeek(Carbon::MONDAY)->addDays(6);

        $chamadosAbertosHoje = Chamado::whereDate('created_at', $hoje)->count();

        $chamadosConcluidosSemanaQuery = Chamado::where('concluido', true)
                                           ->whereBetween('created_at', [$inicioSemana->startOfDay(), $fimSemana->endOfDay()]);

        $chamadosConcluidosSemana = $chamadosConcluidosSemanaQuery->count();
        $faturamentoSemana = $chamadosConcluidosSemanaQuery->sum('valor_total');

        $faturamentoMes = Chamado::where('concluido', true)
                                 ->whereMonth('created_at', now()->month)
                                 ->whereYear('created_at', now()->year)
                                 ->sum('valor_total');

        $tiposServicoData = Chamado::where('chamados.concluido', true)
            ->whereMonth('chamados.created_at', now()->month)
            ->join('tipos_chamado', 'chamados.tipo_id', '=', 'tipos_chamado.id')
            ->select(
                'tipos_chamado.nome', 
                DB::raw('count(*) as total'),
                DB::raw('SUM(chamados.valor_total) as faturamento')
            )
            ->groupBy('tipos_chamado.nome')
            ->orderBy('total', 'desc')
            ->get();

        $chartLabels = $tiposServicoData->pluck('nome');
        $chartData = $tiposServicoData->pluck('total');
        $chartFaturamento = $tiposServicoData->pluck('faturamento'); 

        return view('dashboard', [
            'chamadosAbertosHoje' => $chamadosAbertosHoje,
            'chamadosConcluidosSemana' => $chamadosConcluidosSemana,
            'hoje' => $hoje,
            'inicioSemana' => $inicioSemana->toDateString(),
            'fimSemana' => $fimSemana->toDateString(),
            'faturamentoSemana' => $faturamentoSemana,
            'faturamentoMes' => $faturamentoMes,
            'chartLabels' => $chartLabels,
            'chartData' => $chartData,
            'chartFaturamento' => $chartFaturamento,
        ]);
    }
}