<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Veiculos;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Models\Compras;
use Illuminate\View\View;

class PrincipalController extends Controller
{
    public function __construct(
        protected Compras $compras,
        protected Veiculos $veiculos,
    ) {
        //
    }
    
    public function index(): View
    {        
        return view('principal');
    }

    public function dadosGerais(): View
    {
        $compras    = collect();
        $licitacoes = collect();
        $contratos  = collect();
        $veiculos   = collect();
        
        $this->montarColecao($compras, 'grupos', $this->compras->getGrupos());
        $this->montarColecao($compras, 'tipoGrupos', $this->compras->getTipoGrupos());
        $this->montarColecao($compras, 'subGrupos', $this->compras->getSubgrupos());
        $this->montarColecao($compras, 'itens', $this->compras->getItens());
        $this->montarColecao($compras, 'elementoItem', $this->compras->getElementoItem());
        $this->montarColecao($compras, 'historicoMaterial', $this->compras->getHistoricoMaterial());

        $geral = collect();
        $geral->put('compras', $compras);
        $geral->put('veiculos', $veiculos);
        
        return view('geral', compact('geral'));
    }

    private function montarColecao(Collection $collection, string $nome, array $dados): void
    {
        $collection->put($nome, collect([
            'nome'       => ucfirst($nome),
            'quantidade' => count($dados),
            'existe'     => count($dados) > 1,
        ]));
    }
}
