<?php

namespace App\Http\Controllers;

use App\Models\Contratos;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class ContratoController extends Controller
{
    public function __construct(
        protected Contratos $contratos,
    ) {
        //
    }
    
    public function index(): View
    {
        $contratos  = collect();

        $this->montarColecao($contratos, 'acordo', 'Contratos', $this->contratos->getContratos());
        $this->montarColecao($contratos, 'acordoitemdotacao', 'Contrato Sem Dotação', $this->contratos->getContratoSemDotacao(), true);
        
        return view('contrato', compact('contratos'));
    }

    private function montarColecao(Collection $collection, string $tabela, string $nome, array $dados, ?bool $erro = false): void
    {
        $collection->put($tabela, collect([
            'tabela'     => $tabela,
            'nome'       => $nome,
            'quantidade' => count($dados),
            'existe'     => count($dados) > 1,
            'dados'      => collect($dados),
            'erro'       => $erro,
        ]));
    }
}
