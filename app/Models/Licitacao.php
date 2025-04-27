<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Licitacao
{
    public function getProcessos(): array
    {
        $licitacoes = DB::select(<<<SQL
            select *
            from licitacoes.liclicita
        SQL);

        return $licitacoes;
    }

    public function getItensProcesso(): array
    {
        $itensProcessos = DB::select(<<<SQL
            select *
            from licitacoes.liclicitem
        SQL);

        return $itensProcessos;
    }

    public function getModalidades(): array
    {
        $modalidades = DB::select(<<<SQL
            select *
            from licitacoes.cflicita
        SQL);

        return $modalidades;
    }
}
