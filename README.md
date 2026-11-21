# LogiTrack — Gerenciador Logístico

Projeto acadêmico desenvolvido para a disciplina **Fundamentos de Programação para Internet**.

## Tecnologias
- PHP 8+
- MySQL/MariaDB (via XAMPP)
- HTML5, CSS3 e JavaScript
- Bootstrap 5

## Funcionalidades
- Painel com indicadores
- Cadastro, edição e exclusão de produtos
- Cadastro, edição e exclusão de transportadores
- Cadastro, edição e exclusão de endereços
- Criação de fretes com um transportador, origem, destino e vários produtos
- Relatório de fretes por data com exportação CSV

## Como executar
1. Instale o XAMPP.
2. Copie a pasta `LogiTrack` para `C:\\xampp\\htdocs\\`.
3. Abra o XAMPP Control Panel e inicie **Apache** e **MySQL**.
4. Acesse `http://localhost/phpmyadmin`.
5. Importe o arquivo `database.sql`.
6. Acesse `http://localhost/LogiTrack`.

## Banco de dados
O banco chama-se `logitrack`. A configuração local fica em `config/database.php` (usuário padrão `root`, senha vazia).

## Estrutura
- `config/`: conexão com banco
- `includes/`: cabeçalho e rodapé
- `assets/`: CSS e JavaScript
- arquivos PHP: páginas e funcionalidades

## Observação
Aplicação acadêmica para execução local. Antes de publicar em hospedagem real, configure credenciais seguras, proteção CSRF, autenticação e permissões.
