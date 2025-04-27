<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contratos
{
    use HasFactory;

    public function getContratos(): array
    {
        $contratos = DB::select(<<<SQL
            select *
            from acordos.acordo
        SQL);

        return $contratos;
    }

    public function getItensContrato(): array
    {
        $itensContrato = DB::select(<<<SQL
            select *
            from acordos.acordoitem
        SQL);

        return $itensContrato;
    }

    public function getDotacoesContrato(): array
    {
        $dotacoesContrato = DB::select(<<<SQL
            select *
            from acordos.acordoitemdotacao
        SQL);

        return $dotacoesContrato;
    }

    public function getContratoSemDotacao(): array
    {
        $contratoSemDotacao = DB::select(<<<SQL
            select distinct on (ac16_sequencial)
                ac16_sequencial,
                ac16_numero,
                ac16_anousu
            from acordos.acordo
            inner join acordos.acordoposicao on ac26_acordo = ac16_sequencial
            inner join acordos.acordoitem on ac20_acordoposicao = (select max(ac26_sequencial) from acordos.acordoposicao where ac26_acordo = ac16_sequencial)
            where not exists (
                select 1 
                from acordos.acordoitemdotacao
                where ac22_acordoitem = ac20_sequencial
            )
        SQL);

        return $contratoSemDotacao;
    }
}
