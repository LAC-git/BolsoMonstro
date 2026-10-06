<?php
    
    // Requisito de exceção customizada
    class MonstroInvalidoException extends InvalidArgumentException {}
    
    enum MonstroEstado {
        case Normal;
        case Envenenamento;
        case Queimadura;
        case Congelamento;
        case Sono;
        case Derrotado;
    }
    
    trait MonstroTipo {
        private string $tipo = 'Normal';

        public function getTipo(): string { return $this->tipo; }
    }

    final class Monstro {
        use MonstroTipo;

        private MonstroEstado $estado = MonstroEstado::Normal;

        // Construtor não precisa de validação pois é feita na função Monstro::criar()
        private function __construct(
            private string  $nome,
            private int     $vida,
            private int     $velocidade,
            private int     $defesa,
            private int     $ataque,
            private int     $nivel,
            private int     $pontosMov,
            private int     $exp,
            private ?string $golpes,
        ) {}

        public static function criar(
            string $nome,
            int $vida       = 100,
            int $velocidade = 2,
            int $defesa     = 10,
            int $ataque     = 10,
            int $nivel      = 1,
            int $pontosMov  = 1,
            int $exp        = 0,
            ?string $golpes = null,
        ): self {
            $nome = trim($nome);

            if ($nome === '')       { throw new MonstroInvalidoException('O nome do monstro não pode ser vazio.'); }
            if ($vida < 0)          { throw new MonstroInvalidoException('A vida não pode ser negativa.'); }
            if ($velocidade < 0)    { throw new MonstroInvalidoException('A velocidade não pode ser negativa.'); }
            if ($defesa < 0)        { throw new MonstroInvalidoException('A defesa não pode ser negativa.'); }
            if ($ataque < 0)        { throw new MonstroInvalidoException('O ataque não pode ser negativo.'); }
            if ($nivel < 1)         { throw new MonstroInvalidoException('O nível deve ser maior ou igual a 1.'); }
            if ($pontosMov < 0)     { throw new MonstroInvalidoException('Os pontos de movimento não podem ser negativos.'); }
            if ($exp < 0)           { throw new MonstroInvalidoException('A experiência não pode ser negativa.'); }

            return new self($nome,$vida,$velocidade,$defesa,$ataque,$nivel,$pontosMov,$exp,$golpes);
        }
    }

?>
