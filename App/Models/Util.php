<?php

enum ItemCura: string implements JsonSerializable {
    case Potion         = 'Potion';         // +20 hp
    case SuperPotion    = 'SuperPotion';    // +50 hp
    case HyperPotion    = 'HyperPotion';    // +200 hp
    case MaxPotion      = 'MaxPotion';      // recupera 100%
    case FullRestore    = 'FullRestore';    // recupera 100% + cura todas condições
    case Antidote       = 'Antidote';       // cura envenenamento
    case BurnHeal       = 'BurnHeal';       // cura queimadura
    case IceHeal        = 'IceHeal';        // cura congelamento
    case Awakening      = 'Awakening';      // cura sono
    case ParalyzeHeal   = 'ParalyzeHeal';   // cura paralisia
    case FullHeal       = 'FullHeal';       // cura qualquer condição
    case Revive         = 'Revive';         // revive com metade da vida

    public function jsonSerialize(): string { return $this->value; }
}

?>