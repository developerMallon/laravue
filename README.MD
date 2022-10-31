#CRIAR PROJETO LARAVEL NA VERSAO 7.28
-composer create-project --prefer-dist laravel/laravel=7.28 api --> VERSÃO ESPECÍFICA
-composer create-project laravel/laravel api --> VERSÃO ATUAL

#ADICIONAR PACOTE TYMON/JWT
#link: https://jwt-auth.readthedocs.io/en/develop/laravel-installation/

-composer require tymon/jwt-auth
-php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
Obs.: You should now have a config/jwt.php file that allows you to configure the basics of this package.

-php artisan jwt:secret

1º ROUTE chama o CONTROLLER
2º o CONTROLLER passa as informações prop SERVICE fazer o "serviço" de cadastrar, checar, atc...
3º o SERVICE utiliza o MODEL para consultar as informações no BD
4º os REQUESTS são utilizados para validar as informações
5º EVENTS são utilizados para enviar EMAIL após um LISTNER detectar alguma coisa

30/10/2022 - API REFEITA, TESTADO ATÉ VERIFICAÇÃO DE EMAIL E LOGIN
             (VERIFICAR PORQUE NÃO ESTÁ EXIBINDO O TOKEN NO JSON DO RETORNO DO LOGIN)

31/10/2022 16:11 - Corrigido o JWT... Login ok