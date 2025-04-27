<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Contratos;
use App\Models\Licitacoes;
use App\Models\Veiculos;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Models\Compras;
use Illuminate\View\View;

class PrincipalController extends Controller
{
    public function __construct(
        protected Compras $compras,
        protected Licitacoes $licitacoes,
        protected Contratos $contratos,
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
        
        $this->montarColecao($compras, 'pcgrupo', 'Grupos', $this->compras->getGrupos());
        $this->montarColecao($compras, 'pctipo', 'Tipo Grupos', $this->compras->getTipoGrupos());
        $this->montarColecao($compras, 'pcsubgrupo', 'Sub Grupos', $this->compras->getSubgrupos());
        $this->montarColecao($compras, 'pcmater', 'Itens', $this->compras->getItens());
        $this->montarColecao($compras, 'pcmaterele', 'Elemento Item', $this->compras->getElementoItem());
        $this->montarColecao($compras, 'historicomaterial', 'Historico Material', $this->compras->getHistoricoMaterial());
        
        $this->montarColecao($licitacoes, 'liclicita', 'Licitações', $this->licitacoes->getLicitacoes());
        $this->montarColecao($licitacoes, 'liclicitem', 'Itens da Licitação', $this->licitacoes->getItensLicitacao());

        $this->montarColecao($contratos, 'acordo', 'Contratos', $this->contratos->getContratos());
        $this->montarColecao($contratos, 'acordoitem', 'Itens do Contrato', $this->contratos->getItensContrato());
        $this->montarColecao($contratos, 'acordoitemdotacao', 'Dotações do Contrato', $this->contratos->getDotacoesContrato());
        
        $this->montarColecao($veiculos, 'veiculos', 'Veículos', $this->veiculos->getVeiculos());

        $geral = collect();
        $geral->put('compras', $compras);
        $geral->put('licitacoes', $licitacoes);
        $geral->put('contratos', $contratos);
        $geral->put('veiculos', $veiculos);
        
        return view('geral', compact('geral'));
    }

    private function montarColecao(Collection $collection, string $tabela, string $nome, array $dados): void
    {
        $collection->put($tabela, collect([
            'tabela'     => $tabela,
            'nome'       => $nome,
            'quantidade' => count($dados),
            'existe'     => count($dados) > 1,
        ]));
    }
}
