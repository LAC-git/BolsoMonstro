<?php

class MonstroInvalidoException extends InvalidArgumentException {}

enum MonstroEstado: string implements JsonSerializable {
    case Normal        = 'Normal';
    case Envenenamento = 'Envenenamento';
    case Queimadura    = 'Queimadura';
    case Congelamento  = 'Congelamento';
    case Sono          = 'Sono';
    case Paralisia     = 'Paralisia';

    public function jsonSerialize(): string { return $this->value; }
}

trait MonstroTipo {
    private string $tipo = 'Normal';

    public function get_tipo(): string { return $this->tipo; }
    public function set_tipo(string $tipo): void {
        throw new BadMethodCallException('Tipo do monstro não deve ser modificado.');
    }
}

final class Monstro implements JsonSerializable {
    use MonstroTipo;

    private MonstroEstado $estado = MonstroEstado::Normal;

    private function __construct(
        private ?int    $id,
        private string  $nome,
        private int     $vida_atual,
        private int     $vida_maxima,
        private int     $velocidade,
        private int     $defesa,
        private int     $ataque,
        private int     $nivel,
        private int     $pontos_mov,
        private int     $exp,
        private ?string $golpes,
    ) {}

    public static function criar(
        string  $nome,
        int     $vida_maxima = 100,
        int     $velocidade  = 2,
        int     $defesa      = 10,
        int     $ataque      = 10,
        int     $nivel       = 1,
        int     $pontos_mov  = 1,
        int     $exp         = 0,
        ?string $golpes      = null,
        ?int    $id          = null,
        ?int    $vida_atual  = null
    ): self {
        $nome = trim($nome);
        $vida_atual = $vida_atual ?? $vida_maxima;

        if ($nome === '')       { throw new MonstroInvalidoException('O nome do monstro não pode ser vazio.'); }
        if ($vida_maxima <= 0)  { throw new MonstroInvalidoException('A vida máxima deve ser maior que zero.'); }
        if ($vida_atual < 0)    { throw new MonstroInvalidoException('A vida atual não pode ser negativa.'); }
        if ($velocidade < 0)    { throw new MonstroInvalidoException('A velocidade não pode ser negativa.'); }
        if ($defesa < 0)        { throw new MonstroInvalidoException('A defesa não pode ser negativa.'); }
        if ($ataque < 0)        { throw new MonstroInvalidoException('O ataque não pode ser negativo.'); }
        if ($nivel < 1)         { throw new MonstroInvalidoException('O nível deve ser maior ou igual a 1.'); }
        if ($pontos_mov < 0)    { throw new MonstroInvalidoException('Os pontos de movimento não podem ser negativos.'); }
        if ($exp < 0)           { throw new MonstroInvalidoException('A experiência não pode ser negativa.'); }

        return new self($id, $nome, $vida_atual, $vida_maxima, $velocidade, $defesa, $ataque, $nivel, $pontos_mov, $exp, $golpes);
    }

    public function esta_desmaiado(): bool {
        throw new BadMethodCallException('Não implementado ainda.');
    }

    public function aplicar_cura(int $quantidade): void {
        throw new BadMethodCallException('Não implementado ainda.');
    }

    public function reviver(): void {
        throw new BadMethodCallException('Não implementado ainda.');
    }

    public function mudar_estado(): void {
        throw new BadMethodCallException('Não implementado ainda.');
    }

    public function jsonSerialize(): array {
        return [
            'id'               => $this->id,
            'nome'             => $this->nome,
            'tipo'             => $this->get_tipo(),
            'estado'           => $this->estado,
            'vida_atual'       => $this->vida_atual,
            'vida_maxima'      => $this->vida_maxima,
            'velocidade'       => $this->velocidade,
            'defesa'           => $this->defesa,
            'ataque'           => $this->ataque,
            'nivel'            => $this->nivel,
            'pontos_movimento' => $this->pontos_mov,
            'experiencia'      => $this->exp,
            'golpes'           => $this->golpes,
        ];
    }

    public function get_id(): ?int              { return $this->id; }
    public function get_nome(): string          { return $this->nome; }
    public function get_vida_atual(): int       { return $this->vida_atual; }
    public function get_vida_maxima(): int      { return $this->vida_maxima; }
    public function get_velocidade(): int       { return $this->velocidade; }
    public function get_defesa(): int           { return $this->defesa; }
    public function get_ataque(): int           { return $this->ataque; }
    public function get_nivel(): int            { return $this->nivel; }
    public function get_pontos_mov(): int       { return $this->pontos_mov; }
    public function get_exp(): int              { return $this->exp; }
    public function get_golpes(): ?string       { return $this->golpes; }
    public function get_estado(): MonstroEstado { return $this->estado; }
}

?>