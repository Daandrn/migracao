<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait SequenciasComprasTrait
{
    public function getSequenciaGrupos(): array
    {
        $dados = DB::selectOne(<<<SQL
            select
                last_value,
                (select max(pc03_codgrupo) from pcgrupo) as max_id
            from pcgrupo_pc03_codgrupo_seq
        SQL);

        return $this->verificarSequencia($dados, 'Grupos');
    }

    public function getSequenciaTiposDeGrupos(): array
    {
        $dados = DB::selectOne(<<<SQL
            select
                last_value,
                (select max(pc05_codtipo) from pctipo) as max_id
            from pctipo_pc05_codtipo_seq
        SQL);

        return $this->verificarSequencia($dados, 'Tipos de Grupos');
    }

    public function getSequenciaSubgrupos(): array
    {
        $dados = DB::selectOne(<<<SQL
            select
                last_value,
                (select max(pc04_codsubgrupo) from pcsubgrupo) as max_id
            from pcsubgrupo_pc04_codsubgrupo_seq
        SQL);

        return $this->verificarSequencia($dados, 'Subgrupos');
    }

    public function getSequenciaItensCompras(): array
    {
        $dados = DB::selectOne(<<<SQL
            select
                last_value,
                (select max(pc01_codmater) from pcmater) as max_id
            from pcmater_pc01_codmater_seq
        SQL);

        return $this->verificarSequencia($dados, 'Itens de Compras');
    }

    public function getSequenciaSubelementosItens(): array
    {
        $dados = DB::selectOne(<<<SQL
            select
                max(pc07_codmater) as max_id
            from pcmaterele
        SQL);

        return $this->verificarSequenciaSemSequencia($dados, 'Subelementos de Itens');
    }

    public function getSequenciaHistoricoMaterial(): array
    {
        $dados = DB::selectOne(<<<SQL
            select
                last_value,
                (select max(db150_sequencial) from historicomaterial) as max_id
            from historicomaterial_db150_sequencial_seq
        SQL);

        return $this->verificarSequencia($dados, 'Histórico de Material');
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

    private function verificarSequenciaSemSequencia(?object $dados, string $descricao): array
    {
        if (is_null($dados) || is_null($dados->max_id)) {
            return [
                'descricao' => $descricao,
                'status' => 'nao encontrado',
                'last_value' => null,
                'max_id' => null,
            ];
        }

        return [
            'descricao' => $descricao,
            'status' => 'correto',
            'last_value' => $dados->max_id,
            'max_id' => $dados->max_id,
        ];
    }
}
