<?php

enum ItemCura: string implements JsonSerializable {
    case Potion         = 'Potion';         // +20 hp
    case SuperPotion    = 'SuperPotion';    // +50 hp
    case HyperPotion    = 'HyperPotion';    // +200 hp
    case MaxPotion      = 'MaxPotion';      // recupera 100%
    case FullRestore    = 'FullRestore';    // recupera 100% + cura todas condições

    public function jsonSerialize(): string { return $this->value; }
}

?>