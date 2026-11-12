<?php

namespace App\Traits;

use InvalidArgumentException;

// Trait responsável por fornecer o "tipo" do monstro (Fogo, Água, Terra etc.)
// e o cálculo de vantagem entre tipos, atendendo ao requisito do PDF
// "Pokémon precisa 'herdar' (trait) os tipos".
trait TemTipo
{
    protected string $tipo = 'Normal';

    public function get_tipo(): string
    {
        return $this->tipo;
    }

    public function set_tipo(string $tipo): void
    {
        $tipo = trim($tipo);
        if ($tipo === '') {
            throw new InvalidArgumentException('O tipo do monstro não pode ser vazio.');
        }
        if (mb_strlen($tipo) > 50) {
            throw new InvalidArgumentException('O tipo do monstro deve ter no máximo 50 caracteres.');
        }
        $this->tipo = $tipo;
    }

    // Multiplicador de dano entre este monstro e outro tipo.
    // 2.0 = vantagem, 0.5 = desvantagem, 1.0 = neutro.
    public function multiplicador_contra(string $outro_tipo): float
    {
        $vantagens = [
            'Fogo'     => ['Planta', 'Gelo'],
            'Agua'     => ['Fogo', 'Terra'],
            'Terra'    => ['Eletrico', 'Fogo'],
            'Planta'   => ['Agua', 'Terra'],
            'Eletrico' => ['Agua'],
            'Normal'   => [],
        ];

        $meu   = $this->tipo;
        $outro = $outro_tipo;

        if (in_array($outro, $vantagens[$meu] ?? [], true)) {
            return 2.0;
        }
        if (in_array($meu, $vantagens[$outro] ?? [], true)) {
            return 0.5;
        }
        return 1.0;
    }
}