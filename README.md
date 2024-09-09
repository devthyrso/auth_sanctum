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
7. Para funcionar a função de resetar senha, deve-se atualizar as seguintes linhas no .env:

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=3ed90076441964
MAIL_PASSWORD=3eeafffca0b8f2

Usei o https://mailtrap.io/ para testar, e as credenciais acima, são as da minha conta, crie uma e use as suas para testar.

## Funcionalidades

- **Cadastro de Usuários** com validação de CEP e integração com API ViaCEP.
- **Login e Autenticação** utilizando tokens do Sanctum.
- **Recuperação de Senha** com envio de e-mail.
- **Página Home** mostrando todos os usuários cadastrados.

## Estrutura do Código

O projeto segue os princípios SOLID e utiliza Services, Models, Controllers, e Events.

## Autor

Desenvolvido por Pedro Thyrso.
