<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\SequenciasComprasTrait;
use Illuminate\Support\Facades\DB;

class Compras
{
    use SequenciasComprasTrait;
    
    public function getGrupos(): array
    {
        $grupo = DB::select(<<<SQL
            select * 
            from compras.pcgrupo
        SQL);
        
        return $grupo;
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
                    and coalesce(db150_codunid, 555555) = coalesce(pc01_unid, 555555) 
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
}
