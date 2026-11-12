<?php
// =========================================================
// View: monstros.php
// Catálogo ("Pokédex") de monstros do BolsoMonstro.
// Normalmente o controller injeta $monstros (objetos Monstro ou arrays).
// O bloco de fallback abaixo permite abrir direto durante o desenvolvimento.
// =========================================================

// Garante que o autoload esteja registrado mesmo quando a view é
// aberta diretamente pela URL (sem passar por um controller).
require_once __DIR__ . '/../../../config/autoload.php';

if (!isset($monstros) || !is_array($monstros) || count($monstros) === 0) {
    $seed = [
        ['id'=>1,'nome'=>'Charmander','tipo'=>'Fogo',    'vida_maxima'=>100,'vida_atual'=>100,'velocidade'=>3,'defesa'=>8, 'ataque'=>12,'nivel'=>5,'estado'=>'Normal',  'golpes'=>['Brasas','Arranhão']],
        ['id'=>2,'nome'=>'Squirtle',  'tipo'=>'Agua',    'vida_maxima'=>110,'vida_atual'=>110,'velocidade'=>2,'defesa'=>12,'ataque'=>9, 'nivel'=>5,'estado'=>'Normal',  'golpes'=>["Jato d'Água",'Tackle']],
        ['id'=>3,'nome'=>'Bulbasaur', 'tipo'=>'Planta',  'vida_maxima'=>115,'vida_atual'=>115,'velocidade'=>2,'defesa'=>11,'ataque'=>10,'nivel'=>5,'estado'=>'Normal',  'golpes'=>['Chicote de Vinha','Tackle']],
        ['id'=>4,'nome'=>'Pikachu',   'tipo'=>'Eletrico','vida_maxima'=>95, 'vida_atual'=>95, 'velocidade'=>5,'defesa'=>7, 'ataque'=>14,'nivel'=>6,'estado'=>'Normal',  'golpes'=>['Choque do Trovão','Tackle']],
        ['id'=>5,'nome'=>'Geodude',   'tipo'=>'Terra',   'vida_maxima'=>120,'vida_atual'=>120,'velocidade'=>1,'defesa'=>14,'ataque'=>10,'nivel'=>4,'estado'=>'Normal',  'golpes'=>['Tackle','Pedrada']],
        ['id'=>6,'nome'=>'Eevee',     'tipo'=>'Normal',  'vida_maxima'=>105,'vida_atual'=>105,'velocidade'=>3,'defesa'=>10,'ataque'=>11,'nivel'=>5,'estado'=>'Normal',  'golpes'=>['Tackle','Ataque Rápido']],
        ['id'=>7,'nome'=>'Magikarp',  'tipo'=>'Agua',    'vida_maxima'=>80, 'vida_atual'=>80, 'velocidade'=>2,'defesa'=>5, 'ataque'=>4, 'nivel'=>3,'estado'=>'Normal',  'golpes'=>['Tackle']],
        ['id'=>8,'nome'=>'Gastly',    'tipo'=>'Normal',  'vida_maxima'=>90, 'vida_atual'=>90, 'velocidade'=>4,'defesa'=>7, 'ataque'=>13,'nivel'=>5,'estado'=>'Dormindo','golpes'=>['Lambida','Hipnose']],
    ];

    $monstros = [];
    foreach ($seed as $d) {
        $monstros[] = new \App\Models\Monstro(
            nome:        $d['nome'],
            tipo:        $d['tipo'],
            vida_maxima: $d['vida_maxima'],
            velocidade:  $d['velocidade'],
            defesa:      $d['defesa'],
            ataque:      $d['ataque'],
            nivel:       $d['nivel'],
            vida_atual:  $d['vida_atual'],
            estado:      $d['estado'],
            golpes:      $d['golpes'],
            id:          $d['id'],
        );
    }
}

if (!function_exists('tipo_emoji')) {
    function tipo_emoji(string $tipo): string {
        return match (strtolower($tipo)) {
            'fogo'     => '🔥',
            'agua'     => '💧',
            'terra'    => '🪨',
            'planta'   => '🌿',
            'eletrico' => '⚡',
            'normal'   => '⭐',
            'gelo'     => '❄️',
            'veneno'   => '☠️',
            'psiquico' => '🔮',
            default    => '🥚',
        };
    }
}

if (!function_exists('tipo_cor')) {
    function tipo_cor(string $tipo): array {
        return match (strtolower($tipo)) {
            'fogo'     => ['#fde4d1', '#b45309'],
            'agua'     => ['#dbeafe', '#1d4ed8'],
            'terra'    => ['#ede0c7', '#7c5a1c'],
            'planta'   => ['#d7f0dd', '#166534'],
            'eletrico' => ['#fef9c3', '#a16207'],
            'normal'   => ['#e5e7eb', '#374151'],
            'gelo'     => ['#cffafe', '#0e7490'],
            'veneno'   => ['#ede9fe', '#5b21b6'],
            'psiquico' => ['#fce7f3', '#9d174d'],
            default    => ['#f3f4f6', '#374151'],
        };
    }
}

if (!function_exists('estado_cor')) {
    function estado_cor(string $estado): array {
        return match ($estado) {
            'Normal'     => ['#dcfce7', '#166534'],
            'Veneno'     => ['#ede9fe', '#5b21b6'],
            'Queimado'   => ['#fee2e2', '#991b1b'],
            'Congelado'  => ['#cffafe', '#0e7490'],
            'Dormindo'   => ['#e0e7ff', '#3730a3'],
            'Paralisado' => ['#fef3c7', '#92400e'],
            'Desmaiado'  => ['#e5e7eb', '#374151'],
            default      => ['#f3f4f6', '#374151'],
        };
    }
}

/**
 * Normaliza um item (Monstro ou array) para o formato consumido pela view.
 * Usa "duck typing" (method_exists) em vez de instanceof para não
 * depender do autoload da classe Monstro no caminho de fallback.
 */
function normalizar_monstro($m): array {
    if (is_object($m) && method_exists($m, 'jsonSerialize')) {
        $dados = $m->jsonSerialize();
        if (is_array($dados)) {
            return $dados;
        }
    }
    if (is_array($m)) {
        $vidaMax = (int) ($m['vida_maxima'] ?? 1);
        $vidaAt  = (int) ($m['vida_atual'] ?? 0);
        return $m + [
            'tipo'             => 'Normal',
            'estado'           => 'Normal',
            'golpes'           => [],
            'pontos_movimento' => 1,
            'experiencia'      => 0,
            'percentual_vida'  => $vidaMax > 0 ? round(($vidaAt / $vidaMax) * 100, 1) : 0,
            'desmaiado'        => $vidaAt <= 0,
            'ativo'            => $m['ativo'] ?? true,
        ];
    }
    throw new InvalidArgumentException('Formato de monstro inválido no catálogo.');
}

$catalogo = [];
foreach ($monstros as $m) {
    $catalogo[] = normalizar_monstro($m);
}

// Coleta de tipos e estados únicos para montar os filtros
$tipos_disponiveis   = [];
$estados_disponiveis = [];
foreach ($catalogo as $m) {
    $tipos_disponiveis[$m['tipo']]     = true;
    $estados_disponiveis[$m['estado']] = true;
}
$tipos_disponiveis   = array_keys($tipos_disponiveis);
$estados_disponiveis = array_keys($estados_disponiveis);
sort($tipos_disponiveis);
sort($estados_disponiveis);

$total = count($catalogo);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BolsoMonstro | Monstros</title>
    <style>
        :root {
            --bg: #f4efe7;
            --panel: #ffffff;
            --panel-soft: #f8f4ef;
            --line: #e8e0d1;
            --text: #1f2937;
            --muted: #5f6b76;
            --primary: #c87f1d;
            --primary-soft: #fbf0dc;
            --secondary: #2d5dba;
            --secondary-soft: #ebf1ff;
            --success: #1d7a6b;
            --success-soft: #eafaf5;
            --danger: #b42318;
            --danger-soft: #fdeaea;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            padding: 32px 18px;
        }

        .page-shell {
            width: min(1120px, 100%);
            margin: 0 auto;
            display: grid;
            gap: 22px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        h1 { margin: 0; font-size: clamp(2rem, 4vw, 2.8rem); }

        .nav-link, .button, .secondary-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            border-radius: 10px;
            padding: 10px 16px;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            border: 1px solid transparent;
            font-family: inherit;
        }

        .nav-link {
            background: var(--secondary-soft);
            color: var(--secondary);
            border-color: #dbe7ff;
        }

        .button {
            background: var(--primary-soft);
            color: var(--primary);
            border-color: #f1ddbb;
        }

        .secondary-button {
            background: var(--success-soft);
            color: var(--success);
            border-color: #d5efe9;
        }

        .section-card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 22px;
            box-shadow: 0 12px 28px rgba(31, 41, 55, 0.05);
        }

        /* Filtros */
        .filtros {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 14px;
            align-items: end;
        }

        @media (max-width: 720px) {
            .filtros { grid-template-columns: 1fr; }
        }

        .field { display: grid; gap: 8px; }

        label { font-weight: 700; font-size: 0.9rem; }

        input[type="search"],
        select {
            width: 100%;
            border: 1px solid var(--line);
            background: var(--panel-soft);
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 1rem;
            color: var(--text);
            font-family: inherit;
        }

        .resumo-filtro {
            margin: 14px 0 0;
            font-size: 0.9rem;
            color: var(--muted);
            font-weight: 700;
        }

        /* Grade de monstros */
        .monster-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 18px;
        }

        .monster-card {
            background: var(--panel-soft);
            border: 2px solid var(--line);
            border-radius: 16px;
            padding: 18px;
            display: grid;
            gap: 12px;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .monster-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 18px rgba(31, 41, 55, 0.08);
        }

        .monster-head {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .monster-emoji {
            width: 52px;
            height: 52px;
            display: grid;
            place-items: center;
            font-size: 1.8rem;
            border-radius: 14px;
            background: var(--panel);
            border: 1px solid var(--line);
            flex-shrink: 0;
        }

        .monster-name {
            font-weight: 800;
            font-size: 1.1rem;
            line-height: 1.2;
        }

        .badges {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 4px;
        }

        .badge {
            display: inline-block;
            font-size: 0.72rem;
            font-weight: 800;
            padding: 3px 9px;
            border-radius: 999px;
            line-height: 1.4;
        }

        .hp-row {
            display: grid;
            gap: 6px;
            font-size: 0.82rem;
            color: var(--muted);
        }

        .hp-row .hp-header {
            display: flex;
            justify-content: space-between;
            font-weight: 700;
            color: var(--text);
        }

        .bar {
            height: 10px;
            background: #e7dfd4;
            border-radius: 999px;
            overflow: hidden;
        }

        .bar > span {
            display: block;
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, #3bb273, #f3b11a);
            transition: width 0.3s ease;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            font-size: 0.82rem;
            color: var(--muted);
        }

        .stats-grid .stat {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 6px 8px;
            text-align: center;
        }

        .stats-grid .stat strong {
            display: block;
            color: var(--text);
            font-size: 0.95rem;
        }

        .golpes {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .golpe {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 999px;
            padding: 3px 10px;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--muted);
        }

        .empty-state {
            padding: 48px 24px;
            text-align: center;
            color: var(--muted);
            background: var(--panel-soft);
            border: 2px dashed var(--line);
            border-radius: 16px;
        }

        .empty-state h2 { color: var(--text); margin: 0 0 8px; }

        .footer-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: flex-end;
        }
    </style>
</head>
<body>
    <main class="page-shell">
        <div class="topbar">
            <h1>Monstros</h1>
            <div class="footer-actions">
                <a class="secondary-button" href="meus-times.php">Meus times</a>
                <a class="button" href="principal.php">Voltar ao menu</a>
            </div>
        </div>

        <section class="section-card">
            <div class="filtros">
                <div class="field">
                    <label for="busca">Buscar por nome</label>
                    <input id="busca" type="search" placeholder="Ex.: Charmander, Pikachu…" autocomplete="off">
                </div>
                <div class="field">
                    <label for="filtro-tipo">Tipo</label>
                    <select id="filtro-tipo">
                        <option value="">Todos os tipos</option>
                        <?php foreach ($tipos_disponiveis as $t): ?>
                            <option value="<?= htmlspecialchars($t) ?>"><?= htmlspecialchars($t) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="field">
                    <label for="filtro-estado">Estado</label>
                    <select id="filtro-estado">
                        <option value="">Todos os estados</option>
                        <?php foreach ($estados_disponiveis as $e): ?>
                            <option value="<?= htmlspecialchars($e) ?>"><?= htmlspecialchars($e) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <p class="resumo-filtro" id="resumo-filtro">
                Mostrando <?= $total ?> de <?= $total ?> monstro(s) do catálogo.
            </p>
        </section>

        <section class="monster-grid" id="monster-grid">
            <?php foreach ($catalogo as $m):
                [$bgTipo, $corTipo] = tipo_cor($m['tipo']);
                [$bgEst, $corEst]   = estado_cor($m['estado']);
                $emoji              = tipo_emoji($m['tipo']);
                $pctVida            = (float) $m['percentual_vida'];
                $nome               = htmlspecialchars($m['nome']);
                $tipo               = htmlspecialchars($m['tipo']);
                $estado             = htmlspecialchars($m['estado']);
                $golpes             = is_array($m['golpes']) ? $m['golpes'] : [];
            ?>
                <article
                    class="monster-card"
                    data-nome="<?= strtolower($nome) ?>"
                    data-tipo="<?= $tipo ?>"
                    data-estado="<?= $estado ?>"
                >
                    <header class="monster-head">
                        <span class="monster-emoji"><?= $emoji ?></span>
                        <div>
                            <div class="monster-name"><?= $nome ?></div>
                            <div class="badges">
                                <span class="badge" style="background: <?= $bgTipo ?>; color: <?= $corTipo ?>;">
                                    <?= $tipo ?>
                                </span>
                                <span class="badge" style="background: <?= $bgEst ?>; color: <?= $corEst ?>;">
                                    <?= $estado ?>
                                </span>
                            </div>
                        </div>
                    </header>

                    <div class="hp-row">
                        <div class="hp-header">
                            <span>HP</span>
                            <span><?= (int)$m['vida_atual'] ?> / <?= (int)$m['vida_maxima'] ?> (<?= $pctVida ?>%)</span>
                        </div>
                        <div class="bar"><span style="width: <?= $pctVida ?>%;"></span></div>
                    </div>

                    <div class="stats-grid">
                        <div class="stat">ATK<strong><?= (int)$m['ataque'] ?></strong></div>
                        <div class="stat">DEF<strong><?= (int)$m['defesa'] ?></strong></div>
                        <div class="stat">SPD<strong><?= (int)$m['velocidade'] ?></strong></div>
                        <div class="stat">LVL<strong><?= (int)$m['nivel'] ?></strong></div>
                        <div class="stat">XP<strong><?= (int)$m['experiencia'] ?></strong></div>
                        <div class="stat">MOV<strong><?= (int)$m['pontos_movimento'] ?></strong></div>
                    </div>

                    <?php if (!empty($golpes)): ?>
                        <div class="golpes">
                            <?php foreach ($golpes as $g): ?>
                                <span class="golpe"><?= htmlspecialchars($g) ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </section>

        <div class="empty-state" id="empty-state" hidden>
            <h2>Nenhum monstro encontrado</h2>
            <p>Ajuste os filtros ou limpe a busca para ver todos os monstros.</p>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const grid      = document.getElementById('monster-grid');
            const cards     = Array.from(grid.querySelectorAll('.monster-card'));
            const busca     = document.getElementById('busca');
            const tipoSel   = document.getElementById('filtro-tipo');
            const estadoSel = document.getElementById('filtro-estado');
            const resumo    = document.getElementById('resumo-filtro');
            const vazio     = document.getElementById('empty-state');
            const total     = cards.length;

            function aplicarFiltros() {
                const termo  = busca.value.trim().toLowerCase();
                const tipo   = tipoSel.value;
                const estado = estadoSel.value;

                let visiveis = 0;
                cards.forEach(card => {
                    const okNome   = !termo  || card.dataset.nome.includes(termo);
                    const okTipo   = !tipo   || card.dataset.tipo   === tipo;
                    const okEstado = !estado || card.dataset.estado === estado;
                    const visivel  = okNome && okTipo && okEstado;
                    card.hidden    = !visivel;
                    if (visivel) visiveis++;
                });

                resumo.textContent = `Mostrando ${visiveis} de ${total} monstro(s) do catálogo.`;
                vazio.hidden = visiveis !== 0;
                grid.hidden  = visiveis === 0;
            }

            busca.addEventListener('input', aplicarFiltros);
            tipoSel.addEventListener('change', aplicarFiltros);
            estadoSel.addEventListener('change', aplicarFiltros);

            aplicarFiltros();
        });
    </script>
</body>
</html>