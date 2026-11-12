<?php

namespace App\Models;

use InvalidArgumentException;

// Exceção customizada.
// Atende ao requisito "mínimo de 3 exceções, 1 customizada".
class MonstroInvalidoException extends InvalidArgumentException {}