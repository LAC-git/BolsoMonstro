# BolsoMonstro

Projeto de um site em PHP orientado a objetos com banco de dados, inspirado em mecânicas de Pokémon, desenvolvido como trabalho escolar com foco em arquitetura MVC, persistência com PDO, consumo de APIs, requisições assíncronas, JSON e lógica de jogo.

## Objetivo

Criar uma versão personalizada de um jogo de monstros em que o usuário possa:

- criar e gerenciar um perfil;
- montar um time de monstros;
- batalhar contra outros monstros ou adversários;
- ganhar dinheiro (pokédollars);
- comprar itens na lojinha;
- registrar logs de batalha;
- manter a estrutura em organização por camadas e classes.

## Regras atendidas

O projeto deve contemplar os seguintes requisitos mínimos:

- PHP orientado a objetos;
- banco de dados com PDO;
- MVC;
- transporte de dados via JSON;
- autoload de classes;
- uso de APIs;
- requisições assíncronas;
- mínimo de 3 exceções, incluindo 1 customizada;
- JavaScript orientado a objetos;
- sobrecarga de métodos;
- composição, agregação e associação;
- controle de usuário / troca de perfis;
- encapsulamento;
- polimorfismo;
- uso de triggers e views;
- 4 agrupamentos do SQL (DDL, DML, DTL e DQL);
- tabelas de logs de batalhas, perfis/usuários e loja;
- treinamento de monstros com tipos (Água, Terra, Fogo, etc.);
- loja com itens restauradores, cura de status, reviver e evolução por compra.

## Estrutura do projeto

```text
BolsoMonstro/
├── LICENSE
├── README.md
├── TAREFAS.md
├── regras
├── api/
│   └── Monstro.php
├── database/
│   └── schema.sql
├── www/
│   ├── index.php
│   ├── login.php
│   ├── team-builder.php
│   └── js/
│       └── (arquivos JavaScript e interações do front-end)
└── .git/
```

## Pastas e responsabilidades

### api/

Contém classes e regras de negócio do sistema, como a entidade de monstro, tratativas de status, ataques, tipos e validações.

### database/

Contém o schema inicial do banco, scripts SQL, views, triggers e estrutura de dados para usuários, monstros, batalha, loja e logs.

### www/

Contém as telas principais do site e os pontos de entrada do frontend e do sistema:

- `index.php`: página inicial / dashboard;
- `login.php`: autenticação de usuário;
- `team-builder.php`: montagem do time de monstros;
- `js/`: scripts assíncronos e interações front-end.

## Funcionalidades principais

### 1. Login e perfis

- cadastro e login de usuário;
- troca de perfil;
- controle de sessão e permissões.

### 2. Time Builder

- seleção de monstros para compor o time;
- validação de limites e regras do jogo;
- visualização de estatísticas.

### 3. Batalha

- sistema de turno;
- cálculo de dano, vida, velocidade e defesa;
- status como veneno, queimadura, sono, congelamento e paralisia;
- log da batalha em tabela específica.

### 4. Loja

Itens mínimos obrigatórios:

- Potions: Potion, Super Potion, Hyper Potion, Max Potion, Full Restore;
- Cura de status: Antidote, Burn Heal, Ice Heal, Awakening, Paralyze Heal, Full Heal;
- Reviver: Revive;
- evolução por compra de item.

### 5. Sistema monetário

- cada vitória gera pokédollars;
- o usuário usa o saldo para comprar itens na loja;
- movimentações financeiras e de itens ficam registradas em banco.

## Stack sugerida

- PHP 8+
- PDO
- MySQL / MariaDB
- HTML5 + CSS
- JavaScript + AJAX
- JSON para comunicação entre camadas

## Entidades principais sugeridas

- Usuário
- Perfil
- Monstro
- Tipo
- Item
- Loja
- Batalha
- LogBatalha
- Time

## Recomendação de desenvolvimento

1. Definir o banco e as estruturas iniciais.
2. Implementar as classes base em `api/`.
3. Criação do sistema de login e perfis.
4. Monte do time.
5. Desenvolvimento da lógica de batalha.
6. Implementação da loja e itens.
7. Registro de logs e views.
8. Requisições assíncronas e JS.
9. Ajustes finais de validação e segurança.

## Observações finais

Este projeto pode seguir uma abordagem inspirada no universo Pokémon, mas com regras próprias, desde que os requisitos técnicos e funcionais da disciplina sejam cumpridos.
