# Desafio Prolife

> Projeto criado para desenvolver o desafio da Prolife

## Instalação

``` bash
# Clonar Projeto
git clone https://github.com/bhfagundes/prolife.git

# Instalar dependências
composer install

# Gerar arquivo de configuração
cp .env.example .env

# Gerar key
php artisan key:generate

# Preencher as variáveis de ambiente referentes ao e-mail no arquivo .env
## MAIL_MAILER=smtp
## MAIL_HOST=HOST
## MAIL_PORT=587
## MAIL_USERNAME=
## MAIL_PASSWORD=
## MAIL_ENCRYPTION=tls
## MAIL_FROM_ADDRESS=
## MAIL_FROM_NAME=
## DESTINATION_MAIL= 'EMAIL DE QUEM RECEBERA O EMAIL DE CONTATO'

# Preencher as variáveis de ambiente referentes ao banco de dados (para este desafio foi utilizado mysql)
## DB_CONNECTION=mysql
## DB_HOST=
## DB_PORT=
## DB_DATABASE=
## DB_USERNAME=
## DB_PASSWORD=

# limpar cache de arquivo de configuração
php artisan config:cache

# comando responsavel para que as variaveis do .env possam ser acessadas na aplicacao
php artisan config:clear

# executar as migrations para o banco de dados
php artisan migrate

# Startar projeto localmente
php artisan serve

```

## Execução
Após executar os passos acima, a aplicação deverá estar de pé. Com o link gerado através do último passo, o primeiro passo é acessar a página de registro e criar uma nova conta. Após este registro, basta logar e acessar a tela Contacts. Nesta tela é possível visulizar os dados cadastrados assim como adicionar e excluir registros.
