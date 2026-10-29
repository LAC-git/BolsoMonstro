-- =========================================================
-- BolsoMonstro - Schema inicial d
-- =========================================================
create database if not exists bolso_monstro;
use bolso_monstro;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha_hash VARCHAR(255) NOT NULL,
    data_criacao TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    ultimo_login TIMESTAMP NULL DEFAULT NULL,
    ativo TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS jogadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    saldo_pokedollars INT NOT NULL DEFAULT 0,
    criado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS tipos_monstro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL UNIQUE,
    descricao VARCHAR(255) NULL,
    criado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS monstros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    tipo_id INT NOT NULL,
    estado VARCHAR(30) NOT NULL DEFAULT 'Normal',
    vida_atual INT NOT NULL DEFAULT 100,
    vida_maxima INT NOT NULL DEFAULT 100,
    velocidade INT NOT NULL DEFAULT 2,
    defesa INT NOT NULL DEFAULT 10,
    ataque INT NOT NULL DEFAULT 10,
    nivel INT NOT NULL DEFAULT 1,
    pontos_movimento INT NOT NULL DEFAULT 1,
    experiencia INT NOT NULL DEFAULT 0,
    golpes JSON NULL,
    ativo TINYINT(1) NOT NULL DEFAULT 1,
    criado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tipo_id) REFERENCES tipos_monstro(id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS time_jogador (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jogador_id INT NOT NULL,
    monstro_id INT NOT NULL,
    posicao INT NOT NULL DEFAULT 1,
    criado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (jogador_id, monstro_id),
    UNIQUE (jogador_id, posicao),
    FOREIGN KEY (jogador_id) REFERENCES jogadores(id) ON DELETE CASCADE,
    FOREIGN KEY (monstro_id) REFERENCES monstros(id) ON DELETE CASCADE,
    CHECK (posicao BETWEEN 1 AND 6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS itens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL UNIQUE,
    tipo VARCHAR(50) NOT NULL,
    raridade VARCHAR(30) NOT NULL DEFAULT 'Comum',
    preco INT NOT NULL DEFAULT 0,
    descricao VARCHAR(255) NULL,
    ativo TINYINT(1) NOT NULL DEFAULT 1,
    criado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS inventario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jogador_id INT NOT NULL,
    item_id INT NOT NULL,
    quantidade INT NOT NULL DEFAULT 0,
    atualizado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE (jogador_id, item_id),
    FOREIGN KEY (jogador_id) REFERENCES jogadores(id) ON DELETE CASCADE,
    FOREIGN KEY (item_id) REFERENCES itens(id) ON DELETE RESTRICT,
    CHECK (quantidade >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS batalhas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jogador_id INT NOT NULL,
    monstro_inimigo_id INT NOT NULL,
    vencedor_id INT NULL,
    resultado VARCHAR(20) NOT NULL,
    dano_causado INT NOT NULL DEFAULT 0,
    dano_recebido INT NOT NULL DEFAULT 0,
    data_inicio TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    data_fim TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (jogador_id) REFERENCES jogadores(id) ON DELETE CASCADE,
    FOREIGN KEY (monstro_inimigo_id) REFERENCES monstros(id) ON DELETE RESTRICT,
    FOREIGN KEY (vencedor_id) REFERENCES jogadores(id) ON DELETE SET NULL,
    CHECK (resultado IN ('Vitoria', 'Derrota', 'Empate'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS log_batalhas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    batalha_id INT NOT NULL,
    turno INT NOT NULL,
    acao_jogador VARCHAR(255) NULL,
    acao_inimigo VARCHAR(255) NULL,
    descricao TEXT NOT NULL,
    criado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (batalha_id) REFERENCES batalhas(id) ON DELETE CASCADE,
    CHECK (turno >= 1)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS transacoes_dinheiro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jogador_id INT NOT NULL,
    tipo VARCHAR(20) NOT NULL,
    valor INT NOT NULL,
    motivo VARCHAR(100) NOT NULL,
    criado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (jogador_id) REFERENCES jogadores(id) ON DELETE CASCADE,
    CHECK (tipo IN ('credito', 'debito')),
    CHECK (valor > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================
-- DML inicial (dados base)
-- =========================================================

INSERT INTO tipos_monstro (nome, descricao) VALUES
    ('Normal', 'Monstro comum sem fraquezas especiais.'),
    ('Fogo', 'Monstro com ataques explosivos e ofensivos.'),
    ('Agua', 'Monstro com ataque e defesa equilibrados.'),
    ('Terra', 'Monstro resistente e robusto.'),
    ('Planta', 'Monstro focado em cura e resistência.'),
    ('Eletrico', 'Monstro rápido e com dano elevado.')
ON DUPLICATE KEY UPDATE nome = nome;

INSERT INTO itens (nome, tipo, raridade, preco, descricao) VALUES
    ('Potion', 'Cura', 'Comum', 200, 'Cura 20 de vida.'),
    ('Super Potion', 'Cura', 'Media', 700, 'Cura 50 de vida.'),
    ('Hyper Potion', 'Cura', 'Media', 1200, 'Cura 200 de vida.'),
    ('Max Potion', 'Cura', 'Rara', 2500, 'Restaura toda a vida do monstro.'),
    ('Full Restore', 'Cura', 'Epica', 3000, 'Cura vida e remove status.'),
    ('Antidote', 'Status', 'Comum', 200, 'Remove veneno.'),
    ('Burn Heal', 'Status', 'Comum', 250, 'Remove queimadura.'),
    ('Ice Heal', 'Status', 'Comum', 250, 'Remove congelamento.'),
    ('Awakening', 'Status', 'Comum', 250, 'Remove sono.'),
    ('Paralyze Heal', 'Status', 'Comum', 250, 'Remove paralisia.'),
    ('Full Heal', 'Status', 'Rara', 600, 'Remove todos os status.'),
    ('Revive', 'Reviver', 'Rara', 1500, 'Revive um monstro desmaiado com metade da vida.')
ON DUPLICATE KEY UPDATE nome = nome;

-- =========================================================
-- Views
-- =========================================================

CREATE OR REPLACE VIEW vw_jogador_resumo AS
SELECT
    j.id AS jogador_id,
    u.nome AS usuario,
    j.nome AS jogador,
    j.nivel,
    j.experiencia,
    j.vida_atual,
    j.vida_maxima,
    j.saldo_pokedollars
FROM jogadores j
INNER JOIN usuarios u ON u.id = j.usuario_id;

CREATE OR REPLACE VIEW vw_inventario_jogador AS
SELECT
    inv.id,
    j.id AS jogador_id,
    j.nome AS jogador,
    it.nome AS item,
    inv.quantidade,
    it.preco
FROM inventario inv
INNER JOIN jogadores j ON j.id = inv.jogador_id
INNER JOIN itens it ON it.id = inv.item_id;

CREATE OR REPLACE VIEW vw_batalha_resumo AS
SELECT
    b.id AS batalha_id,
    j.nome AS jogador,
    m.nome AS monstro_inimigo,
    b.resultado,
    b.dano_causado,
    b.dano_recebido,
    b.data_inicio,
    b.data_fim
FROM batalhas b
INNER JOIN jogadores j ON j.id = b.jogador_id
INNER JOIN monstros m ON m.id = b.monstro_inimigo_id;

-- =========================================================
-- Triggers
-- =========================================================
DELIMITER $$

CREATE TRIGGER trg_batalha_vitoria_credita_saldo
AFTER INSERT ON batalhas
FOR EACH ROW
BEGIN
    IF NEW.vencedor_id = NEW.jogador_id THEN
        INSERT INTO transacoes_dinheiro (jogador_id, tipo, valor, motivo)
        VALUES (NEW.jogador_id, 'credito', 50, 'Vitoria em batalha');

        UPDATE jogadores
        SET saldo_pokedollars = saldo_pokedollars + 50
        WHERE id = NEW.jogador_id;
    END IF;
END$$

CREATE TRIGGER trg_log_batalha_automatico
AFTER INSERT ON log_batalhas
FOR EACH ROW
BEGIN
    UPDATE batalhas
    SET data_fim = CURRENT_TIMESTAMP
    WHERE id = NEW.batalha_id AND data_fim IS NULL;
END$$

DELIMITER ;

-- =========================================================
-- DQL de exemplo
-- =========================================================
-- SELECT * FROM usuarios;
-- SELECT * FROM jogadores;
-- SELECT * FROM monstros;
-- SELECT * FROM inventario;
-- SELECT * FROM vw_jogador_resumo;
-- SELECT * FROM vw_inventario_jogador;
-- SELECT * FROM vw_batalha_resumo;

