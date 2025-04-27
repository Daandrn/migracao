<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licitacoes
{
    use HasFactory;

    public function getLicitacoes(): array
    {
        $licitacoes = DB::select(<<<SQL
            select *
            from licitacao.liclicita
        SQL);

        return $licitacoes;
    }

    public function getItensLicitacao(): array
    {
        $itensLicitacao = DB::select(<<<SQL
            select *
            from licitacao.liclicitem
        SQL);

        return $itensLicitacao;
    }
}
