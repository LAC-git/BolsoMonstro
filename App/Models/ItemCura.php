<?php

enum ItemCura: string implements JsonSerializable {
    case Potion         = 'Potion';
    case SuperPotion    = 'SuperPotion';
    case HyperPotion    = 'HyperPotion';
    case MaxPotion      = 'MaxPotion';
    case FullRestore    = 'FullRestore';
    case Antidote       = 'Antidote';
    case BurnHeal       = 'BurnHeal';
    case IceHeal        = 'IceHeal';
    case Awakening      = 'Awakening';
    case ParalyzeHeal   = 'ParalyzeHeal';
    case FullHeal       = 'FullHeal';
    case Revive         = 'Revive';

    public function jsonSerialize(): string { return $this->value; }
}
