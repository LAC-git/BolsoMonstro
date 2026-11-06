<?php

namespace App\Models;

use InvalidArgumentException;
use JsonSerializable;

class TimeInvalidoException extends InvalidArgumentException {}

class Time implements JsonSerializable
{
    public const MAX_MONSTROS = 6;
    public const MIN_MONSTROS = 1;

    private ?int $id;
    private int $jogador_id;
    private string $nome;
    private ?string $estilo;
    /** @var array<int,int> posicao => monstro_id */
    private array $monstros;
    private bool $ativo;

    /**
     * @param array<int,int> $monstros posicao (1..6) => monstro_id
     */
    public function __construct(
        int $jogador_id,
        string $nome,
        ?string $estilo = null,
        array $monstros = [],
        ?int $id = null,
        bool $ativo = true
    ) {
        $nome = trim($nome);

        if ($jogador_id <= 0) {
            throw new TimeInvalidoException('O time precisa estar vinculado a um jogador válido.');
        }
        if ($nome === '') {
            throw new TimeInvalidoException('O nome do time não pode ser vazio.');
        }
        if (mb_strlen($nome) > 100) {
            throw new TimeInvalidoException('O nome do time deve ter no máximo 100 caracteres.');
        }
        if ($estilo !== null && mb_strlen(trim($estilo)) > 50) {
            throw new TimeInvalidoException('O estilo do time deve ter no máximo 50 caracteres.');
        }
        if (count($monstros) > self::MAX_MONSTROS) {
            throw new TimeInvalidoException('Um time pode ter no máximo ' . self::MAX_MONSTROS . ' monstros.');
        }

        $this->id         = $id;
        $this->jogador_id = $jogador_id;
        $this->nome       = $nome;
        $this->estilo     = $estilo !== null ? trim($estilo) : null;
        $this->monstros   = [];
        $this->ativo      = $ativo;

        $posicoes = [];
        $ids      = [];
        foreach ($monstros as $posicao => $monstro_id) {
            $posicao    = (int) $posicao;
            $monstro_id = (int) $monstro_id;

            $this->validar_posicao($posicao);
            $this->validar_monstro_id($monstro_id);

            if (isset($posicoes[$posicao])) {
                throw new TimeInvalidoException("Já existe um monstro na posição {$posicao}.");
            }
            if (isset($ids[$monstro_id])) {
                throw new TimeInvalidoException("O monstro {$monstro_id} já está no time.");
            }

            $posicoes[$posicao] = true;
            $ids[$monstro_id]   = true;
            $this->monstros[$posicao] = $monstro_id;
        }

        ksort($this->monstros);
    }

    private function validar_posicao(int $posicao): void
    {
        if ($posicao < 1 || $posicao > self::MAX_MONSTROS) {
            throw new TimeInvalidoException(
                'Posição inválida. Use valores entre 1 e ' . self::MAX_MONSTROS . '.'
            );
        }
    }

    private function validar_monstro_id(int $monstro_id): void
    {
        if ($monstro_id <= 0) {
            throw new TimeInvalidoException('O ID do monstro deve ser maior que zero.');
        }
    }

    public function adicionar_monstro(int $monstro_id, ?int $posicao = null): int
    {
        $this->validar_monstro_id($monstro_id);

        if (in_array($monstro_id, $this->monstros, true)) {
            throw new TimeInvalidoException("O monstro {$monstro_id} já está no time.");
        }
        if ($this->esta_cheio()) {
            throw new TimeInvalidoException('O time já está cheio.');
        }

        $posicao = $posicao ?? $this->proxima_posicao_livre();
        $this->validar_posicao($posicao);

        if (isset($this->monstros[$posicao])) {
            throw new TimeInvalidoException("A posição {$posicao} já está ocupada.");
        }

        $this->monstros[$posicao] = $monstro_id;
        ksort($this->monstros);

        return $posicao;
    }

    public function remover_monstro(int $posicao): void
    {
        $this->validar_posicao($posicao);
        unset($this->monstros[$posicao]);
    }

    public function remover_monstro_por_id(int $monstro_id): void
    {
        foreach ($this->monstros as $posicao => $id) {
            if ($id === $monstro_id) {
                unset($this->monstros[$posicao]);
                return;
            }
        }
    }

    public function proxima_posicao_livre(): int
    {
        for ($i = 1; $i <= self::MAX_MONSTROS; $i++) {
            if (!isset($this->monstros[$i])) {
                return $i;
            }
        }
        throw new TimeInvalidoException('Não há posições livres no time.');
    }

    public function esta_pronto(): bool
    {
        return count($this->monstros) >= self::MIN_MONSTROS;
    }

    public function esta_cheio(): bool
    {
        return count($this->monstros) >= self::MAX_MONSTROS;
    }

    public function quantidade_monstros(): int
    {
        return count($this->monstros);
    }

    public function get_id(): ?int             { return $this->id; }
    public function get_jogador_id(): int      { return $this->jogador_id; }
    public function get_nome(): string         { return $this->nome; }
    public function get_estilo(): ?string      { return $this->estilo; }
    public function get_monstros(): array      { return $this->monstros; }
    public function is_ativo(): bool           { return $this->ativo; }

    public function set_id(?int $id): void
    {
        $this->id = $id;
    }

    public function set_nome(string $nome): void
    {
        $nome = trim($nome);
        if ($nome === '') {
            throw new TimeInvalidoException('O nome do time não pode ser vazio.');
        }
        $this->nome = $nome;
    }

    public function set_estilo(?string $estilo): void
    {
        $this->estilo = $estilo !== null ? trim($estilo) : null;
    }

    public function set_ativo(bool $ativo): void
    {
        $this->ativo = $ativo;
    }

    public function jsonSerialize(): array
    {
        return [
            'id'         => $this->id,
            'jogador_id' => $this->jogador_id,
            'nome'       => $this->nome,
            'estilo'     => $this->estilo,
            'monstros'   => $this->monstros,
            'quantidade' => $this->quantidade_monstros(),
            'pronto'     => $this->esta_pronto(),
            'ativo'      => $this->ativo,
        ];
    }
}