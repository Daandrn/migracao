<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Contrato
{
    public function getContratosVigenciaIncorreta(): array
    {
        $contratosVigenciaIncorreta = DB::select(<<<SQL
            select *
            from acordo
            where ac16_datafim < '2025-01-01'
            order by ac16_numero::int, ac16_anousu
        SQL);

        return $contratosVigenciaIncorreta;
    }

    public function getItensDuplicadosContrato(): array
    {
        $itensDuplicados = DB::select(<<<SQL
            select ac26_acordo, ac20_acordoposicao, ac20_pcmater
            from acordoitem
            left join acordoposicao on ac20_acordoposicao = ac26_sequencial
            group by ac26_acordo, ac20_acordoposicao, ac20_pcmater
            having count(ac20_pcmater) > 1
        SQL);

        return $itensDuplicados;
    }

    public function getContratosOrdemItensIncorreta(): array
    {
        $contratosOrdemItensIncorreta = DB::select(<<<SQL
            with itens_com_ordem as (
                select
                    ac20_sequencial,
                    ac20_acordoposicao,
                    ac20_ordem,
                    row_number() over (partition by ac20_acordoposicao order by ac20_ordem) as ordem_esperada
                from acordoitem
            )
            select itens_com_ordem.*, acordoposicao.ac26_acordo
            from itens_com_ordem
            left join acordoposicao on itens_com_ordem.ac20_acordoposicao = ac26_sequencial
            where ac20_ordem != ordem_esperada
            order by ac20_acordoposicao, ac20_ordem
        SQL);

        return $contratosOrdemItensIncorreta;
    }

    public function getContratosSemVinculoProcesso(): array
    {
        $contratosSemVinculo = DB::select(<<<SQL
            select ac16_sequencial, ac16_numero, ac16_anousu
            from acordo
            where ac16_licitacao is null
            order by ac16_numero::int, ac16_anousu
        SQL);

        return $contratosSemVinculo;
    }

    public function getContratosSemItens(): array
    {
        $contratosSemItens = DB::select(<<<SQL
            select *
            from acordo
            left join acordoposicao on ac26_acordo = ac16_sequencial
            left join acordoitem on ac20_acordoposicao = ac26_sequencial
            where ac20_pcmater is null
            order by ac16_numero::int, ac16_anousu
        SQL);

        return $contratosSemItens;
    }

    public function getContratosSemDotacoesUltimaPosicao(): array
    {
        $contratosSemDotacoes = DB::select(<<<SQL
            select distinct on (ac16_sequencial)
                ac16_sequencial
            from acordo
            inner join acordoposicao on ac26_acordo = ac16_sequencial
            inner join acordoitem on ac20_acordoposicao = (
                select max(ac26_sequencial)
                from acordoposicao
                where ac26_acordo = ac16_sequencial
            )
            where not exists (
                select 1
                from acordoitemdotacao
                where ac22_acordoitem = ac20_sequencial
            )
        SQL);

        return $contratosSemDotacoes;
    }

    public function getAcordo(): array
    {
        $acordo = DB::select(<<<SQL
            select *
            from acordo
        SQL);

        return $acordo;
    }

    public function getAcordoItem(): array
    {
        $acordoItem = DB::select(<<<SQL
            select *
            from acordoitem
        SQL);

        return $acordoItem;
    }

    public function getAcordoPosicao(): array
    {
        $acordoPosicao = DB::select(<<<SQL
            select *
            from acordoposicao
        SQL);

        return $acordoPosicao;
    }

    public function getAcordoItemDotacao(): array
    {
        $acordoItemDotacao = DB::select(<<<SQL
            select *
            from acordoitemdotacao
        SQL);

        return $acordoItemDotacao;
    }
}
