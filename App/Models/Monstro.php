<?php

namespace App\Models;

use App\Traits\TemTipo;
use JsonSerializable;

class Monstro implements JsonSerializable
{
    use TemTipo;

    public const ESTADOS_VALIDOS = [
        'Normal',
        'Veneno',
        'Queimado',
        'Congelado',
        'Dormindo',
        'Paralisado',
        'Desmaiado',
    ];

    private ?int    $id;
    private string  $nome;
    private string  $estado;
    private int     $vida_atual;
    private int     $vida_maxima;
    private int     $velocidade;
    private int     $defesa;
    private int     $ataque;
    private int     $nivel;
    private int     $pontos_movimento;
    private int     $experiencia;
    private array   $golpes;
    private bool    $ativo;

    public function __construct(
        string  $nome,
        string  $tipo               = 'Normal',
        int     $vida_maxima        = 100,
        int     $velocidade         = 2,
        int     $defesa             = 10,
        int     $ataque             = 10,
        int     $nivel              = 1,
        int     $vida_atual         = null,
        string  $estado             = 'Normal',
        int     $pontos_movimento   = 1,
        int     $experiencia        = 0,
        array   $golpes             = [],
        bool    $ativo              = true,
        ?int    $id                 = null
    ) {
        $nome = trim($nome);
        if ($nome === '')           { throw new MonstroInvalidoException('O nome do monstro não pode ser vazio.'); }
        if (mb_strlen($nome) > 100) { throw new MonstroInvalidoException('O nome do monstro deve ter no máximo 100 caracteres.'); }
        if ($vida_maxima <= 0)      { throw new MonstroInvalidoException('A vida máxima deve ser maior que zero.'); }
        if ($nivel < 1)             { throw new MonstroInvalidoException('O nível do monstro deve ser no mínimo 1.'); }
        if ($velocidade < 0 || $defesa < 0 || $ataque < 0)      { throw new MonstroInvalidoException('Os atributos de combate não podem ser negativos.'); }
        if (!in_array($estado, self::ESTADOS_VALIDOS, true))    { throw new MonstroInvalidoException('Estado inválido: ' . $estado . '.'); }

        $vida_atual = $vida_atual ?? $vida_maxima;
        if ($vida_atual < 0 || $vida_atual > $vida_maxima) { throw new MonstroInvalidoException('A vida atual deve estar entre 0 e a vida máxima.'); }

        foreach ($golpes as $golpe) {
            if (!is_string($golpe) || trim($golpe) === '') { throw new MonstroInvalidoException('Cada golpe deve ser uma string não vazia.'); }
        }

        $this->id               = $id;
        $this->nome             = $nome;
        $this->estado           = $estado;
        $this->vida_maxima      = $vida_maxima;
        $this->vida_atual       = $vida_atual;
        $this->velocidade       = $velocidade;
        $this->defesa           = $defesa;
        $this->ataque           = $ataque;
        $this->nivel            = $nivel;
        $this->pontos_movimento = $pontos_movimento;
        $this->experiencia      = $experiencia;
        $this->golpes           = array_values($golpes);
        $this->ativo            = $ativo;
        $this->set_tipo($tipo);
    }

    /* ------- Regras de domínio ------- */

    public function receber_dano(int $dano): int
    {
        if ($dano < 0) { throw new MonstroInvalidoException('O dano não pode ser negativo.'); }
        $this->vida_atual = max(0, $this->vida_atual - $dano);
        if ($this->vida_atual === 0 && $this->estado !== 'Desmaiado') {
            $this->estado = 'Desmaiado';
        }
        return $this->vida_atual;
    }

    public function curar(int $quantidade): int
    {
        if ($quantidade < 0) { throw new MonstroInvalidoException('A quantidade de cura não pode ser negativa.'); }
        $this->vida_atual = min($this->vida_maxima, $this->vida_atual + $quantidade);
        if ($this->vida_atual > 0 && $this->estado === 'Desmaiado') {
            $this->estado = 'Normal';
        }
        return $this->vida_atual;
    }

    public function curar_total(): void
    {
        $this->vida_atual = $this->vida_maxima;
        if ($this->estado !== 'Normal') {
            $this->estado = 'Normal';
        }
    }

    public function reviver(): void
    {
        if (!$this->desmaiado()) { throw new MonstroInvalidoException('Somente monstros desmaiados podem ser revividos.'); }
        $this->vida_atual = (int) ceil($this->vida_maxima / 2);
        $this->estado     = 'Normal';
    }

    public function desmaiado(): bool { return $this->vida_atual <= 0; }
    public function esta_vivo(): bool  { return !$this->desmaiado(); }

    public function aplicar_status(string $status): void
    {
        if (!in_array($status, self::ESTADOS_VALIDOS, true)) { throw new MonstroInvalidoException('Status inválido: ' . $status . '.'); }
        if ($this->desmaiado() && $status !== 'Desmaiado') { throw new MonstroInvalidoException('Monstros desmaiados precisam ser revividos antes de receber status.'); }
        $this->estado = $status;
    }

    public function limpar_status(): void
    {
        if (!$this->desmaiado()) {
            $this->estado = 'Normal';
        }
    }

    public function experiencia_para_proximo_nivel(): int
    {
        return $this->nivel * 100;
    }

    public function ganhar_experiencia(int $xp): void
    {
        if ($xp < 0) { throw new MonstroInvalidoException('A experiência não pode ser negativa.'); }
        $this->experiencia += $xp;
        
        while ($this->experiencia >= $this->experiencia_para_proximo_nivel()) {
            $this->experiencia -= $this->experiencia_para_proximo_nivel();
            $this->subir_nivel();
        }
    }

    private function subir_nivel(): void
    {
        $this->nivel++;
        $this->vida_maxima += 5;
        $this->vida_atual   = $this->vida_maxima;
        $this->ataque      += 1;
        $this->defesa      += 1;
    }

    public function percentual_vida(): float
    {
        if ($this->vida_maxima === 0) { return 0.0; }
        return round(($this->vida_atual / $this->vida_maxima) * 100, 1);
    }

    /* ------- Getters ------- */

    public function get_id(): ?int              { return $this->id; }
    public function get_nome(): string          { return $this->nome; }
    public function get_estado(): string        { return $this->estado; }
    public function get_vida_atual(): int       { return $this->vida_atual; }
    public function get_vida_maxima(): int      { return $this->vida_maxima; }
    public function get_velocidade(): int       { return $this->velocidade; }
    public function get_defesa(): int           { return $this->defesa; }
    public function get_ataque(): int           { return $this->ataque; }
    public function get_nivel(): int            { return $this->nivel; }
    public function get_pontos_movimento(): int { return $this->pontos_movimento; }
    public function get_experiencia(): int      { return $this->experiencia; }
    public function get_golpes(): array         { return $this->golpes; }
    public function is_ativo(): bool            { return $this->ativo; }

    /* ------- Setters ------- */

    public function set_id(?int $id): void { $this->id = $id; }

    public function set_nome(string $nome): void
    {
        $nome = trim($nome);
        if ($nome === '') { throw new MonstroInvalidoException('O nome do monstro não pode ser vazio.'); }
        $this->nome = $nome;
    }

    public function set_estado(string $estado): void
    {
        $this->aplicar_status($estado);
    }

    public function set_velocidade(int $velocidade): void
    {
        if ($velocidade < 0) { throw new MonstroInvalidoException('A velocidade não pode ser negativa.'); }
        $this->velocidade = $velocidade;
    }

    public function set_defesa(int $defesa): void
    {
        if ($defesa < 0) { throw new MonstroInvalidoException('A defesa não pode ser negativa.'); }
        $this->defesa = $defesa;
    }

    public function set_ataque(int $ataque): void
    {
        if ($ataque < 0) { throw new MonstroInvalidoException('O ataque não pode ser negativo.'); }
        $this->ataque = $ataque;
    }

    public function set_golpes(array $golpes): void
    {
        foreach ($golpes as $golpe) {
            if (!is_string($golpe) || trim($golpe) === '') { throw new MonstroInvalidoException('Cada golpe deve ser uma string não vazia.'); }
        }
        $this->golpes = array_values($golpes);
    }

    public function set_ativo(bool $ativo): void { $this->ativo = $ativo; }

    public function jsonSerialize(): array
    {
        return [
            'id'                        => $this->id,
            'nome'                      => $this->nome,
            'tipo'                      => $this->tipo,
            'estado'                    => $this->estado,
            'vida_atual'                => $this->vida_atual,
            'vida_maxima'               => $this->vida_maxima,
            'velocidade'                => $this->velocidade,
            'defesa'                    => $this->defesa,
            'ataque'                    => $this->ataque,
            'nivel'                     => $this->nivel,
            'pontos_movimento'          => $this->pontos_movimento,
            'experiencia'               => $this->experiencia,
            'experiencia_proximo_nivel' => $this->experiencia_para_proximo_nivel(),
            'golpes'                    => $this->golpes,
            'percentual_vida'           => $this->percentual_vida(),
            'desmaiado'                 => $this->desmaiado(),
            'ativo'                     => $this->ativo,
        ];
    }
}