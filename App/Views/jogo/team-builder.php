<?php
// =========================================================
// View: team-builder.php
// Normalmente o controller injeta $monstros (catálogo) e $estilos.
// Fallback abaixo permite abrir direto durante o desenvolvimento.
// =========================================================
if (!isset($monstros) || !is_array($monstros)) {
    $monstros = [
        ['id'=>1,'nome'=>'Charmander','tipo'=>'Fogo',    'vida_maxima'=>100,'vida_atual'=>100,'velocidade'=>3,'defesa'=>8, 'ataque'=>12,'nivel'=>5,'estado'=>'Normal'],
        ['id'=>2,'nome'=>'Squirtle',  'tipo'=>'Agua',    'vida_maxima'=>110,'vida_atual'=>110,'velocidade'=>2,'defesa'=>12,'ataque'=>9, 'nivel'=>5,'estado'=>'Normal'],
        ['id'=>3,'nome'=>'Bulbasaur', 'tipo'=>'Planta',  'vida_maxima'=>115,'vida_atual'=>115,'velocidade'=>2,'defesa'=>11,'ataque'=>10,'nivel'=>5,'estado'=>'Normal'],
        ['id'=>4,'nome'=>'Pikachu',   'tipo'=>'Eletrico','vida_maxima'=>95, 'vida_atual'=>95, 'velocidade'=>5,'defesa'=>7, 'ataque'=>14,'nivel'=>6,'estado'=>'Normal'],
        ['id'=>5,'nome'=>'Geodude',   'tipo'=>'Terra',   'vida_maxima'=>120,'vida_atual'=>120,'velocidade'=>1,'defesa'=>14,'ataque'=>10,'nivel'=>4,'estado'=>'Normal'],
        ['id'=>6,'nome'=>'Eevee',     'tipo'=>'Normal',  'vida_maxima'=>105,'vida_atual'=>105,'velocidade'=>3,'defesa'=>10,'ataque'=>11,'nivel'=>5,'estado'=>'Normal'],
        ['id'=>7,'nome'=>'Magikarp',  'tipo'=>'Agua',    'vida_maxima'=>80, 'vida_atual'=>80, 'velocidade'=>2,'defesa'=>5, 'ataque'=>4, 'nivel'=>3,'estado'=>'Normal'],
        ['id'=>8,'nome'=>'Gastly',    'tipo'=>'Normal',  'vida_maxima'=>90, 'vida_atual'=>90, 'velocidade'=>4,'defesa'=>7, 'ataque'=>13,'nivel'=>5,'estado'=>'Sono'],
    ];
}

$estilos       = $estilos ?? ['Equilibrado', 'Ofensivo', 'Defensivo', 'Velocista', 'Tático'];
$max_monstros  = 6;
$min_monstros  = 1;

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
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BolsoMonstro | Criar time</title>
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
            width: min(1080px, 100%);
            margin: 0 auto;
            display: grid;
            gap: 24px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        h1 { margin: 0; font-size: clamp(2rem, 4vw, 2.8rem); }

        .nav-link,
        .button,
        .secondary-button,
        .danger-button {
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
        }

        .nav-link {
            background: var(--secondary-soft);
            color: var(--secondary);
            border-color: #dbe7ff;
        }

        .section-card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 12px 28px rgba(31, 41, 55, 0.05);
        }

        .section-card h2 {
            margin: 0 0 6px;
            font-size: 1.35rem;
        }

        .section-card .hint {
            margin: 0 0 18px;
            color: var(--muted);
            font-size: 0.92rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
        }

        .field { display: grid; gap: 8px; }

        label { font-weight: 700; }

        input[type="text"],
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

        /* ------- Cards de monstros ------- */
        .monster-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
            gap: 16px;
        }

        .monster-card {
            background: var(--panel-soft);
            border: 2px solid var(--line);
            border-radius: 16px;
            padding: 16px;
            text-align: left;
            cursor: pointer;
            display: grid;
            gap: 10px;
            transition: transform 0.15s ease, border-color 0.15s ease, box-shadow 0.15s ease;
            font: inherit;
            color: inherit;
        }

        .monster-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 18px rgba(31, 41, 55, 0.08);
        }

        .monster-card.selected {
            border-color: var(--primary);
            background: var(--primary-soft);
            box-shadow: 0 0 0 3px rgba(200, 127, 29, 0.15);
        }

        .monster-head {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .monster-emoji {
            width: 44px;
            height: 44px;
            display: grid;
            place-items: center;
            font-size: 1.5rem;
            border-radius: 12px;
            background: var(--panel);
            border: 1px solid var(--line);
            flex-shrink: 0;
        }

        .monster-name { font-weight: 800; font-size: 1rem; line-height: 1.2; }

        .monster-tipo {
            display: inline-block;
            margin-top: 2px;
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--muted);
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 999px;
            padding: 2px 8px;
        }

        .monster-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 6px 12px;
            font-size: 0.82rem;
            color: var(--muted);
        }

        .monster-stats strong { color: var(--text); }

        .monster-badge {
            justify-self: start;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--primary);
            background: var(--primary-soft);
            border-radius: 999px;
            padding: 4px 10px;
        }

        .monster-card.selected .monster-badge {
            color: var(--success);
            background: var(--success-soft);
        }

        /* ------- Slots do time ------- */
        .slots-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 14px;
        }

        .contador {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--muted);
        }

        .slots-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 12px;
        }

        .slot {
            position: relative;
            border: 2px dashed var(--line);
            border-radius: 14px;
            padding: 14px;
            min-height: 130px;
            background: var(--panel-soft);
            display: grid;
            align-content: center;
            justify-items: center;
            gap: 6px;
            text-align: center;
        }

        .slot.filled {
            border-style: solid;
            border-color: var(--success);
            background: var(--success-soft);
        }

        .slot-pos {
            position: absolute;
            top: 8px;
            left: 10px;
            font-size: 0.75rem;
            font-weight: 800;
            color: var(--muted);
        }

        .slot-emoji { font-size: 1.8rem; }

        .slot strong { font-size: 0.95rem; }

        .slot-tipo {
            font-size: 0.75rem;
            color: var(--muted);
        }

        .slot-empty {
            font-size: 0.85rem;
            color: var(--muted);
        }

        .slot-remove {
            position: absolute;
            top: 6px;
            right: 8px;
            background: var(--danger-soft);
            color: var(--danger);
            border: 1px solid #f7d1cf;
            border-radius: 8px;
            width: 26px;
            height: 26px;
            display: grid;
            place-items: center;
            cursor: pointer;
            font-weight: 800;
            font-size: 0.8rem;
        }

        /* ------- Ações / mensagens ------- */
        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
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

        .danger-button {
            background: var(--danger-soft);
            color: var(--danger);
            border-color: #f7d1cf;
        }

        .form-error {
            min-height: 20px;
            margin-top: 12px;
            color: var(--danger);
            font-weight: 700;
            font-size: 0.9rem;
        }

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
            <h1>Criar time</h1>
            <a class="nav-link" href="principal.php">Voltar ao menu</a>
        </div>

        <form id="form-time" action="meus-times.php" method="post">
            <!-- 1) Informações do time -->
            <section class="section-card">
                <h2>1. Informações do time</h2>
                <p class="hint">Dê um nome ao seu time e escolha um estilo de jogo.</p>
                <div class="info-grid">
                    <div class="field">
                        <label for="nome-time">Nome do time</label>
                        <input id="nome-time" name="nome-time" type="text"
                               placeholder="Ex.: Esquadrão Trovão" maxlength="100" required>
                    </div>
                    <div class="field">
                        <label for="estilo">Estilo</label>
                        <select id="estilo" name="estilo">
                            <option value="">Selecione</option>
                            <?php foreach ($estilos as $e): ?>
                                <option value="<?= htmlspecialchars($e) ?>"><?= htmlspecialchars($e) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </section>

            <!-- 2) Catálogo de monstros -->
            <section class="section-card">
                <h2>2. Escolha seus monstros</h2>
                <p class="hint">
                    Clique em um card para adicionar ao time (até <?= $max_monstros ?> monstros).
                    Clique novamente para remover.
                </p>

                <div class="monster-grid" id="monster-grid">
                    <?php foreach ($monstros as $m):
                        $emoji = tipo_emoji($m['tipo'] ?? '');
                    ?>
                        <button type="button"
                                class="monster-card"
                                data-id="<?= (int)$m['id'] ?>"
                                data-nome="<?= htmlspecialchars($m['nome']) ?>"
                                data-tipo="<?= htmlspecialchars($m['tipo']) ?>"
                                data-emoji="<?= $emoji ?>"
                                data-vida="<?= (int)$m['vida_maxima'] ?>"
                                data-ataque="<?= (int)$m['ataque'] ?>"
                                data-defesa="<?= (int)$m['defesa'] ?>"
                                data-velocidade="<?= (int)$m['velocidade'] ?>"
                                data-nivel="<?= (int)$m['nivel'] ?>">
                            <div class="monster-head">
                                <span class="monster-emoji"><?= $emoji ?></span>
                                <div>
                                    <div class="monster-name"><?= htmlspecialchars($m['nome']) ?></div>
                                    <span class="monster-tipo"><?= htmlspecialchars($m['tipo']) ?></span>
                                </div>
                            </div>
                            <div class="monster-stats">
                                <span>HP <strong><?= (int)$m['vida_maxima'] ?></strong></span>
                                <span>Nv <strong><?= (int)$m['nivel'] ?></strong></span>
                                <span>ATK <strong><?= (int)$m['ataque'] ?></strong></span>
                                <span>DEF <strong><?= (int)$m['defesa'] ?></strong></span>
                                <span>SPD <strong><?= (int)$m['velocidade'] ?></strong></span>
                                <span>Estado <strong><?= htmlspecialchars($m['estado'] ?? 'Normal') ?></strong></span>
                            </div>
                            <span class="monster-badge">Adicionar</span>
                        </button>
                    <?php endforeach; ?>
                </div>
            </section>

            <!-- 3) Slots do time -->
            <section class="section-card">
                <div class="slots-header">
                    <h2>3. Composição do time</h2>
                    <span class="contador" id="contador-monstros">0 de <?= $max_monstros ?> monstros selecionados</span>
                </div>
                <p class="hint">Cada slot corresponde a uma posição no time (1 a <?= $max_monstros ?>).</p>
                <div class="slots-grid" id="team-slots"></div>
                <div id="slots-inputs"></div>
                <div class="form-error" id="form-erro" role="alert"></div>
            </section>

            <div class="footer-actions">
                <a class="secondary-button" href="meus-times.php">Ver meus times</a>
                <a class="danger-button" href="batalha/selecionar-times.php">Ir para batalha</a>
                <button class="button" type="submit">Salvar time</button>
            </div>
        </form>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const MAX = <?= $max_monstros ?>;
            const MIN = <?= $min_monstros ?>;

            const selecionados = []; // ordem de seleção → ordem dos slots
            const cards = document.querySelectorAll('.monster-card');
            const slotsContainer = document.getElementById('team-slots');
            const contador = document.getElementById('contador-monstros');
            const form = document.getElementById('form-time');
            const erroEl = document.getElementById('form-erro');
            const inputsContainer = document.getElementById('slots-inputs');

            const jaSelecionado = (id) => selecionados.some(m => m.id === id);

            function escapeHtml(str) {
                return String(str).replace(/[&<>"']/g, c => ({
                    '&': '&amp;', '<': '&lt;', '>': '&gt;',
                    '"': '&quot;', "'": '&#39;'
                }[c]));
            }

            function renderizarSlots() {
                slotsContainer.innerHTML = '';
                for (let i = 1; i <= MAX; i++) {
                    const m = selecionados[i - 1];
                    const slot = document.createElement('div');
                    slot.className = 'slot' + (m ? ' filled' : '');
                    slot.dataset.posicao = i;

                    if (m) {
                        slot.innerHTML = `
                            <span class="slot-pos">#${i}</span>
                            <button type="button" class="slot-remove"
                                    data-remove="${m.id}"
                                    aria-label="Remover ${escapeHtml(m.nome)}">✕</button>
                            <div class="slot-emoji">${m.emoji}</div>
                            <strong>${escapeHtml(m.nome)}</strong>
                            <span class="slot-tipo">${escapeHtml(m.tipo)} · Nv ${m.nivel}</span>
                        `;
                    } else {
                        slot.innerHTML = `
                            <span class="slot-pos">#${i}</span>
                            <span class="slot-empty">Posição vazia</span>
                        `;
                    }
                    slotsContainer.appendChild(slot);
                }

                // Atualiza contador e hidden inputs
                contador.textContent = `${selecionados.length} de ${MAX} monstros selecionados`;

                inputsContainer.innerHTML = '';
                for (let i = 1; i <= MAX; i++) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = `monstros[${i}]`;
                    input.value = selecionados[i - 1] ? selecionados[i - 1].id : '';
                    inputsContainer.appendChild(input);
                }
            }

            function atualizarCards() {
                cards.forEach(card => {
                    const id = parseInt(card.dataset.id, 10);
                    const sel = jaSelecionado(id);
                    card.classList.toggle('selected', sel);
                    const badge = card.querySelector('.monster-badge');
                    if (badge) badge.textContent = sel ? 'Selecionado' : 'Adicionar';
                });
            }

            function toggle(card) {
                const id = parseInt(card.dataset.id, 10);
                const idx = selecionados.findIndex(m => m.id === id);

                if (idx >= 0) {
                    selecionados.splice(idx, 1);
                } else {
                    if (selecionados.length >= MAX) {
                        erroEl.textContent = `Seu time já tem ${MAX} monstros. Remova um para adicionar outro.`;
                        return;
                    }
                    selecionados.push({
                        id,
                        nome: card.dataset.nome,
                        tipo: card.dataset.tipo,
                        emoji: card.dataset.emoji,
                        nivel: parseInt(card.dataset.nivel, 10),
                    });
                }

                erroEl.textContent = '';
                renderizarSlots();
                atualizarCards();
            }

            cards.forEach(card => {
                card.addEventListener('click', (e) => {
                    e.preventDefault();
                    toggle(card);
                });
            });

            slotsContainer.addEventListener('click', (e) => {
                const btn = e.target.closest('[data-remove]');
                if (!btn) return;
                const id = parseInt(btn.dataset.remove, 10);
                const idx = selecionados.findIndex(m => m.id === id);
                if (idx >= 0) {
                    selecionados.splice(idx, 1);
                    renderizarSlots();
                    atualizarCards();
                }
            });

            form.addEventListener('submit', (e) => {
                if (selecionados.length < MIN) {
                    e.preventDefault();
                    erroEl.textContent = `Selecione pelo menos ${MIN} monstro(s) para salvar o time.`;
                    return;
                }
            });

            renderizarSlots();
            atualizarCards();
        });
    </script>
</body>
</html>