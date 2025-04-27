<?php 

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait SequenciasVeiculosTrait
{
    public function getSequenciaCentrais(): array
    {
        $dados = DB::selectOne(<<<SQL
            select
                last_value,
                (select max(ve36_sequencial) from veiccadcentral) as max_id
            from veiccadcentral_ve36_sequencial_seq
        SQL);

        return $this->verificarSequencia($dados, 'centrais');
    }

    public function getSequenciaCentraisPorDepartamento(): array
    {
        $dados = DB::selectOne(<<<SQL
            select
                last_value,
                (select max(ve37_sequencial) from veiccadcentraldepart) as max_id
            from veiccadcentraldepart_ve37_sequencial_seq
        SQL);

        return $this->verificarSequencia($dados, 'centrais por departamento');
    }

    public function getSequenciaMotoristas(): array
    {
        $dados = DB::selectOne(<<<SQL
            select
                last_value,
                (select max(ve05_codigo) from veicmotoristas) as max_id
            from veicmotoristas_ve05_codigo_seq
        SQL);

        return $this->verificarSequencia($dados, 'motoristas');
    }

    public function getSequenciaCentraisDosMotoristas(): array
    {
        $dados = DB::selectOne(<<<SQL
            select
                last_value,
                (select max(ve41_sequencial) from veicmotoristascentral) as max_id
            from veicmotoristascentral_ve41_sequencial_seq
        SQL);

        return $this->verificarSequencia($dados, 'centrais dos motoristas');
    }

    public function getSequenciaModelos(): array
    {
        $dados = DB::selectOne(<<<SQL
            select
                last_value,
                (select max(ve22_codigo) from veiccadmodelo) as max_id
            from veiccadmodelo_ve22_codigo_seq
        SQL);

        return $this->verificarSequencia($dados, 'modelos');
    }

    public function getSequenciaCores(): array
    {
        $dados = DB::selectOne(<<<SQL
            select
                last_value,
                (select max(ve23_codigo) from veiccadcor) as max_id
            from veiccadcor_ve23_codigo_seq
        SQL);

        return $this->verificarSequencia($dados, 'cores');
    }

    public function getSequenciaMarcas(): array
    {
        $dados = DB::selectOne(<<<SQL
            select
                last_value,
                (select max(ve21_codigo) from veiccadmarca) as max_id
            from veiccadmarca_ve21_codigo_seq
        SQL);

        return $this->verificarSequencia($dados, 'marcas');
    }

    public function getSequenciaCombustiveis(): array
    {
        $dados = DB::selectOne(<<<SQL
            select
                last_value,
                (select max(ve26_codigo) from veiccadcomb) as max_id
            from veiccadcomb_ve26_codigo_seq
        SQL);

        return $this->verificarSequencia($dados, 'combustiveis');
    }

    public function getSequenciaVeiculos(): array
    {
        $dados = DB::selectOne(<<<SQL
            select
                last_value,
                (select max(ve01_codigo) from veiculos) as max_id
            from veiculos_ve01_codigo_seq
        SQL);

        return $this->verificarSequencia($dados, 'veiculos');
    }

    public function getSequenciaTiposDeVeiculos(): array
    {
        $dados = DB::selectOne(<<<SQL
            select
                last_value,
                (select max(si04_sequencial) from tipoveiculos) as max_id
            from sic_tipoveiculos_si04_sequencial_seq
        SQL);

        return $this->verificarSequencia($dados, 'tipos de veiculos');
    }

    public function getSequenciaResponsaveis(): array
    {
        $dados = DB::selectOne(<<<SQL
            select
                last_value,
                (select max(ve02_codigo) from veicresp) as max_id
            from veicresp_ve02_codigo_seq
        SQL);

        return $this->verificarSequencia($dados, 'responsaveis');
    }

    public function getSequenciaCentraisDosVeiculos(): array
    {
        $dados = DB::selectOne(<<<SQL
            select
                last_value,
                (select max(ve40_sequencial) from veiccentral) as max_id
            from veiccentral_ve40_sequencial_seq
        SQL);

        return $this->verificarSequencia($dados, 'centrais dos veiculos');
    }

    public function getSequenciaCombustiveisDosVeiculos(): array
    {
        $dados = DB::selectOne(<<<SQL
            select
                last_value,
                (select max(ve06_sequencial) from veiculoscomb) as max_id
            from veiculoscomb_ve06_sequencial_seq
        SQL);

        return $this->verificarSequencia($dados, 'combustiveis dos veiculos');
    }

    public function getSequenciaBaixaDeVeiculos(): array
    {
        $dados = DB::selectOne(<<<SQL
            select
                last_value,
                (select max(ve04_codigo) from veicbaixa) as max_id
            from veicbaixa_ve04_codigo_seq
        SQL);

        return $this->verificarSequencia($dados, 'baixa de veiculos');
    }

    private function verificarSequencia(?object $dados, string $descricao): array
    {
        if (is_null($dados) || is_null($dados->max_id)) {
            return [
                'descricao' => $descricao,
                'status' => 'nao encontrado',
                'last_value' => $dados->last_value ?? null,
                'max_id' => $dados->max_id ?? null,
            ];
        }

        if ($dados->last_value >= $dados->max_id) {
            return [
                'descricao' => $descricao,
                'status' => 'correto',
                'last_value' => $dados->last_value,
                'max_id' => $dados->max_id,
            ];
        }

        return [
            'descricao' => $descricao,
            'status' => 'incorreto',
            'last_value' => $dados->last_value,
            'max_id' => $dados->max_id,
        ];
    }
}
