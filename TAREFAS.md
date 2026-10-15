# Tarefas do projeto BolsoMonstro

## Visão geral

Este arquivo organiza o desenvolvimento do projeto conforme a estrutura atual do repositório e os requisitos das regras do trabalho.

## Estrutura base do projeto

- [ ] Criar/organizar a estrutura de pastas do repositório
  - [ ] `api/`
  - [ ] `database/`
  - [ ] `www/`
  - [ ] `www/js/`
- [ ] Garantir que o arquivo `LICENSE` esteja presente
- [ ] Garantir que `README.md` e `TAREFAS.md` estejam atualizados

## 1. Configuração inicial

- [ ] Definir estrutura MVC do projeto
- [x] Criar autoload das classes
- [ ] Configurar conexão com banco via PDO
- [ ] Definir constantes de ambiente e configurações iniciais
- [ ] Preparar base de rotas e arquivos do front-end

## 2. Banco de dados e SQL

### `database/schema.sql`

- [ ] Criar tabela de usuários / perfis
- [ ] Criar tabela de monstros
- [ ] Criar tabela de tipos
- [ ] Criar tabela de time / equipe
- [ ] Criar tabela de itens da loja
- [ ] Criar tabela de inventário do usuário
- [ ] Criar tabela de batalhas
- [ ] Criar tabela de logs de batalhas
- [ ] Criar tabela de transações de dinheiro
- [ ] Definir DDL, DML, DTL e DQL corretamente
- [ ] Criar triggers para atualizar logs e saldo
- [ ] Criar views mínimas obrigatórias
- [ ] Validar integridade e chaves estrangeiras

## 3. Entidades e regras de negócio

### `api/Monstro.php`

- [ ] Definir classe `Monstro`
- [ ] Criar atributos mínimos: nome, HP/vida, velocidade
- [ ] Implementar atributos adicionais conforme regras:
  - [ ] ataque
  - [ ] defesa
  - [ ] nível
  - [ ] experiência
  - [ ] status
  - [ ] tipo
- [ ] Implementar trait para tipos
- [ ] Criar validadores de dados
- [ ] Implementar exceções personalizadas
- [ ] Implementar pelo menos 3 exceções
- [ ] Garantir encapsulamento com getters e setters apropriados
- [ ] Usar polimorfismo em métodos relevantes
- [ ] Definir overloading/assinaturas padronizadas conforme a linguagem

## 4. Sistema de Login e Usuário

- [ ] Criar tela de login
- [ ] Criar cadastro de usuário
- [ ] Criar sistema de autenticação
- [ ] Implementar troca de perfil
- [ ] Controlar sessão e permissões
- [ ] Gerenciar saldo em pokédollars

## 5. Team Builder

### `www/team-builder.php`

- [ ] Criar interface de montagem do time
- [ ] Permitir seleção de monstros
- [ ] Validar limite de monstros por time
- [ ] Salvar equipe no banco
- [ ] Exibir estatísticas do time
- [ ] Integrar com backend via JSON ou requisições assíncronas

## 6. Lojinha

- [ ] Criar tela da loja
- [ ] Definir itens básicos obrigatórios
  - [ ] Potion
  - [ ] Super Potion
  - [ ] Hyper Potion
  - [ ] Max Potion
  - [ ] Full Restore
  - [ ] Antidote
  - [ ] Burn Heal
  - [ ] Ice Heal
  - [ ] Awakening
  - [ ] Paralyze Heal
  - [ ] Full Heal
  - [ ] Revive
- [ ] Implementar regras de cura de vida e status
- [ ] Implementar evolução por compra de item
- [ ] Validar saldo do usuário antes da compra
- [ ] Atualizar inventário do usuário

## 7. Sistema de Batalha

- [ ] Criar lógica de turno
- [ ] Definir ataques e cálculo de dano
- [ ] Implementar vida (HP), velocidade e defesa
- [ ] Aplicar verificações de status
- [ ] Implementar condição de desmaio
- [ ] Implementar reviver com metade da vida
- [ ] Registrar log da batalha em banco
- [ ] Adicionar histórico de batalhas
- [ ] Permitir que vitórias gerem dinheiro

## 8. Log de batalhas e gestão de dados

- [ ] Criar tabela de log de batalhas
- [ ] Registrar eventos da batalha
- [ ] Armazenar vencedor, perdedor, dano, status e timestamps
- [ ] Criar view para relatórios de batalha
- [ ] Criar view para dashboard do jogador
- [ ] Criar view para histórico da loja

## 9. API e requisições assíncronas

- [ ] Criar endpoints para monstros
- [ ] Criar endpoints para loja
- [ ] Criar endpoints para batalha
- [ ] Consumir dados em JSON
- [ ] Implementar fetch/AJAX no front-end
- [ ] Tratar erros HTTP e mensagens de retorno

## 10. Interface web e JavaScript

### `www/js/`

- [ ] Criar scripts para login
- [ ] Criar scripts para time builder
- [ ] Criar scripts para loja
- [ ] Criar scripts para batalha
- [ ] Usar JavaScript orientado a objetos
- [ ] Melhorar interação com o usuário
- [ ] Aplicar validações front-end

## 11. Validação e correção

- [ ] Testar cadastro e login
- [ ] Testar montagem de time
- [ ] Testar compra de itens
- [ ] Testar uso de curas e status
- [ ] Testar evolução por item
- [ ] Testar sistema de batalha e logs
- [ ] Verificar regras de saldo e inventário
- [ ] Validar exceções e mensagens
- [ ] Revisar nomes de classes, arquivos e organização

## 12. Entrega final

- [ ] Revisar README.md
- [ ] Revisar TAREFAS.md
- [ ] Verificar estrutura final da pasta
- [ ] Testar fluxo funcional completo do projeto
- [ ] Preparar apresentação e explicação do sistema
- [ ] Enviar projeto ao GitHub conforme prazo do professor

## Critérios de conclusão

O projeto estará concluído quando:

- todas as telas mínimas estiverem implementadas;
- o banco estiver funcionando e documentado;
- os itens, status e sistema de batalha estiverem operando;
- o sistema de login e perfis estiver funcional;
- a loja e a lógica monetária estiverem integradas;
- os logs e as views estiverem implementados;
- o código estiver organizado em MVC e com uso de orientação a objetos.

---

## Observações
