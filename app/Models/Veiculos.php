<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\SequenciasVeiculosTrait;
use Illuminate\Support\Facades\DB;

class Veiculos
{
    use SequenciasVeiculosTrait;
    
    public function getVeiculos(): array
    {
        $veiculos = DB::select(<<<SQL
            select * 
            from veiculos.veiculos
        SQL);

        return $veiculos;
    }

    public function getCepLocalidades(): array
    {
        $cepLocalidades = DB::select(<<<SQL
            select * 
            from public.ceplocalidades
        SQL);

        return $cepLocalidades;
    }

    public function getTipoVeiculos(): array
    {
        $tipoVeiculos = DB::select(<<<SQL
            select * 
            from veiculos.tipoveiculos
        SQL);

        return $tipoVeiculos;
    }

    public function getVeicEspecificacao(): array
    {
        $veicEspecificacao = DB::select(<<<SQL
            select * 
            from veiculos.veicespecificacao
        SQL);

        return $veicEspecificacao;
    }

    public function getVeicCadMarca(): array
    {
        $veicCadMarca = DB::select(<<<SQL
            select * 
            from veiculos.veiccadmarca
        SQL);

        return $veicCadMarca;
    }

    public function getVeicCadModelo(): array
    {
        $veicCadModelo = DB::select(<<<SQL
            select * 
            from veiculos.veiccadmodelo
        SQL);

        return $veicCadModelo;
    }

    public function getVeicCadCor(): array
    {
        $veicCadCor = DB::select(<<<SQL
            select * 
            from veiculos.veiccadcor
        SQL);

        return $veicCadCor;
    }

    public function getVeicCadTipoCapacidade(): array
    {
        $veicCadTipoCapacidade = DB::select(<<<SQL
            select * 
            from veiculos.veiccadtipocapacidade
        SQL);

        return $veicCadTipoCapacidade;
    }

    public function getVeicCadCategCnh(): array
    {
        $veicCadCategCnh = DB::select(<<<SQL
            select * 
            from veiculos.veiccadcategcnh
        SQL);

        return $veicCadCategCnh;
    }

    public function getVeicCadProced(): array
    {
        $veicCadProced = DB::select(<<<SQL
            select * 
            from veiculos.veiccadproced
        SQL);

        return $veicCadProced;
    }

    public function getVeicCadPotencia(): array
    {
        $veicCadPotencia = DB::select(<<<SQL
            select * 
            from veiculos.veiccadpotencia
        SQL);

        return $veicCadPotencia;
    }

    public function getVeicCadCateg(): array
    {
        $veicCadCateg = DB::select(<<<SQL
            select * 
            from veiculos.veiccadcateg
        SQL);

        return $veicCadCateg;
    }

    public function getVeicTipoAbast(): array
    {
        $veicTipoAbast = DB::select(<<<SQL
            select * 
            from veiculos.veictipoabast
        SQL);

        return $veicTipoAbast;
    }

    public function getCepEstados(): array
    {
        $cepEstados = DB::select(<<<SQL
            select * 
            from public.cepestados
        SQL);

        return $cepEstados;
    }

    public function getVeicCentral(): array
    {
        $veicCentral = DB::select(<<<SQL
            select * 
            from veiculos.veiccentral
        SQL);

        return $veicCentral;
    }

    public function getVeicCadCentralDepart(): array
    {
        $veicCadCentralDepart = DB::select(<<<SQL
            select * 
            from veiculos.veiccadcentraldepart
        SQL);

        return $veicCadCentralDepart;
    }

    public function getDbDepart(): array
    {
        $dbDepart = DB::select(<<<SQL
            select * 
            from db_depart
        SQL);

        return $dbDepart;
    }

    public function getVeicResp(): array
    {
        $veicResp = DB::select(<<<SQL
            select * 
            from veiculos.veicresp
        SQL);

        return $veicResp;
    }

    public function getVeiculosComb(): array
    {
        $veiculosComb = DB::select(<<<SQL
            select * 
            from veiculos.veiculoscomb
        SQL);

        return $veiculosComb;
    }

    public function getVeicBaixa(): array
    {
        $veicBaixa = DB::select(<<<SQL
            select * 
            from veiculos.veicbaixa
        SQL);

        return $veicBaixa;
    }
}
