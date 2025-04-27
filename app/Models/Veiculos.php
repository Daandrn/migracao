<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Veiculos
{
    public function getVeiculos(): array
    {
        $veiculos = DB::select(<<<SQL
            select * 
            from veiculos.veiculos
        SQL);
        
        return $veiculos;
    }

    public function getTipoGrupos(): array
    {
        $tipoGrupo = DB::select(<<<SQL
            select * 
            from compras.pctipo
        SQL);
        
        return $tipoGrupo;
    }

    public function getSubgrupos(): array
    {
        $subGrupo = DB::select(<<<SQL
            select * 
            from compras.pcsubgrupo
        SQL);

        return $subGrupo;
    }

    public function getItens(): array
    {
        $itens = DB::select(<<<SQL
            select * 
            from compras.pcmater
        SQL);

        return $itens;
    }

    public function getElementoItem(): array
    {
        $result = DB::select(<<<SQL
            select *
            from compras.pcmaterele
        SQL);

        return $result;
    }

    public function getHistoricoMaterial(): array
    {
        $historicoMaterial = DB::select(<<<SQL
            select *
            from public.historicomaterial
        SQL);

        return $historicoMaterial;
    }

    public function getGruposComDescVazia(): array
    {
        $grupoComDescVazia = DB::select(<<<SQL
            select * 
            from compras.pcgrupo
            where (
                pc03_descrgrupo = '' 
                or pc03_descrgrupo is null
            )
        SQL);
        
        return $grupoComDescVazia;
    }

    public function getGrupoSemElemento(): array    
    {
        $result = DB::select(<<<SQL
            select *
            from compras.pctipo
            where not exists (
                select 1
                from compras.pctipoelemento
                where pc06_codtipo = pc05_codtipo
            )
        SQL);

        return $result;
    }

    public function getItemSemHistoricoMaterial(): array
    {
        $result = DB::select(<<<SQL
            select *
            from compras.pcmater
            where not exists (
                select 1 
                from public.historicomaterial 
                where db150_pcmater = pc01_codmater 
                    and db150_instit = pc01_instit
                    and db150_codunid = pc01_unid 
            )
        SQL);

        return $result;
    }

    public function getItensSemSubelemento(): array
    {
        $result = DB::select(<<<SQL
            select *
            from compras.pcmater
            where not exists (
                select 1
                from compras.pcmaterele
                where pc07_codmater = pc01_codmater
            )
        SQL);

        return $result;
    }

    public function tessste(): array
    {
        return DB::select(<<<SQL
            select *
            from employees
            limit 100
        SQL);
    }
}
