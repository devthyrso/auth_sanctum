# Projeto Laravel com Autenticação via Sanctum

## Tecnologias Utilizadas
Laravel: 10.x
PHP: 8.2
Node.js: 18.8

## Configuração

1. Clone o repositório.
2. Execute `composer install` e `npm install` para instalar as dependências.
3. Copie o arquivo `.env.example` para `.env` e configure o banco de dados.
4. Execute `php artisan migrate` para rodar as migrações.
5. Instale o Sanctum com `composer require laravel/sanctum` e configure conforme o guia.
6. Inicie o servidor com `php artisan serve`.

## Funcionalidades

- **Cadastro de Usuários** com validação de CEP e integração com API ViaCEP.
- **Login e Autenticação** utilizando tokens do Sanctum.
- **Página Home** mostrando todos os usuários cadastrados.

## Estrutura do Código

O projeto segue os princípios SOLID e utiliza Services, Models, Controllers, e Events.

## Autor

Desenvolvido por Pedro Thyrso.
