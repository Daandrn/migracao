<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outros;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class OutrosController extends Controller
{
    public function __construct(
        protected Outros $outros,
    ) {
        //
    }
    
    public function index(): View
    {
        $salaries  = collect();
        $employees = collect();
        
        $this->montarColecao($salaries, 'salaries', $this->outros->getSalaries());
        $this->montarColecao($salaries, 'dsfdsdf', $this->outros->getSalaries());
        $this->montarColecao($employees, 'employees', $this->outros->getEmployees());

        $outros = collect();
        $outros->put('salaries', $salaries);
        $outros->put('employees', $employees);
        
        //dd($outros);
        
        return view('outros', compact('outros'));
    }

    private function montarColecao(Collection $collection, string $nome, array $dados): void
    {
        $collection->put($nome, collect([
            'nome'       => $nome,
            'quantidade' => count($dados),
            'existe'     => count($dados) > 1,
        ]));
    }

}
