<?php

final class Loja {
	private const PRECOS = [
		'Potion'      => 200,
		'SuperPotion' => 700,
		'HyperPotion' => 1200,
		'MaxPotion'   => 2500,
		'FullRestore' => 3000,
		'Antidote'    => 200,
		'BurnHeal'    => 250,
		'IceHeal'     => 250,
		'Awakening'   => 250,
		'ParalyzeHeal'=> 250,
		'FullHeal'    => 600,
		'Revive'      => 1500,
	];

	public function get_precos(): array {
		return self::PRECOS;
	}

	public function get_preco(ItemCura $item): int {
		return self::PRECOS[$item->value];
	}

	/**
	 * @return array{saldo: int, inventario: array<string, int>, total: int}
	 */
	public function comprar(
		ItemCura $item,
		int $quantidade,
		int $saldo,
		array $inventario
	): array {
		if ($quantidade <= 0) { throw new InvalidArgumentException('A quantidade deve ser maior que zero.'); }
		if ($saldo < 0) { throw new InvalidArgumentException('O saldo não pode ser negativo.'); }

		$preco = $this->get_preco($item);
		if ($quantidade > intdiv(PHP_INT_MAX, $preco)) { throw new InvalidArgumentException('A quantidade solicitada é muito grande.'); }

		$total = $preco * $quantidade;
		if ($saldo < $total) { throw new DomainException('Saldo insuficiente para comprar este item.'); }

		$quantidade_atual = $inventario[$item->value] ?? 0;
		if (!is_int($quantidade_atual) || $quantidade_atual < 0) { throw new InvalidArgumentException('A quantidade do item no inventário é inválida.'); }
		if ($quantidade > PHP_INT_MAX - $quantidade_atual) { throw new InvalidArgumentException('A quantidade no inventário excederia o limite permitido.'); }

		$inventario[$item->value] = $quantidade_atual + $quantidade;

		return [
			'saldo'      => $saldo - $total,
			'inventario' => $inventario,
			'total'      => $total,
		];
	}
}

?>
