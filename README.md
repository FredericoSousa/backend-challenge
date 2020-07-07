# mLearn back-end challenge

### Desafio desenvolvido para teste na mLearn

# 1 - Desafio lógico
O código do desafio lógico se encontra na pasta matrix-challenge na raz do projeto.
OBS.: Existe uma versão em JS e uma em PHP.

# 2 - Desafio de aplicação

## Instalação das dependências

Use o [composer](https://getcomposer.org/) para instalar as dependências.

```bash
composer intall
```

## Configuração do .ENV

Para configurar o .env do projeto basta criar um arquivo com o nome de .env na raiz do projeto como sugere o arquivo .env.example

```env
# URL DA APLICAÇÃO
APP_URL = URL da aplicação

# CONFIGURAÇÕES DO BANCO DE DADOS
DB_CONNECTION= conexão/dialeto
DB_HOST= servidor
DB_PORT= porta
DB_DATABASE= nome do banco
DB_USERNAME= usuario
DB_PASSWORD= senha

# CONFIGURAÇÕES DA API mLEARN
MLEARN_AUTH_TOKEN = authorization token sem o Bearer
MLEARN_GROUP_ID = header app-users-group-id
MLEARN_SERVICE_ID = service_id
MLEARN_API_URL = URL da API
```

## Rodando o projeto

Para rodar o projeto basta executar o comando abaixo.

```bash
php -S 0.0.0.0:8000 -t public
```

## Rodando as migrations

Para rodar as migrations basta executar o comando abaixo.

```bash
php artisan migrate
```

## Testes
Os testes ficam localizados no diretorio tests.

Para rodar os testes basta executar o comando abaixo na raiz do projeto.
```bash
vendor/bin/phpunit
```

## Utilização da API
### Criar um usuário
Para criar um usuário basta fazer uma requisição **POST** para a rota **/users** como no exemplo abaixo:

```json
{
	"name":"Nome do Usuário",
	"email":"usuario@email.com",
	"phone":"99999999999",
	"level":"F"
}
```

Exemplo de resposta:

```json
{
  "name":"Nome do Usuário",
  "email":"usuario@email.com",
  "phone":"99999999999",
  "level":"F",
  "id": "id_do_usuario",
  "updated_at": "2020-07-07T03:41:13.000000Z",
  "created_at": "2020-07-07T03:41:12.000000Z",
  "external_id": "id_do_usuario_na_api_mlearn"
}
```

### Listar os usuários
Para listar os usuários basta fazer uma requisição **GET** para a rota **/users**.
Exemplo de resposta:

```json
{
  "current_page": 1,
  "data": [
    {
      "id": "30e2d767-cd0a-4321-a7d3-f277856145ab",
      "name": "Jhon Doe",
      "email": "jhon@doe.com",
      "phone": "12345678900",
      "level": "P",
      "external_id": "5f0403ad815004124b47da40",
      "created_at": "2020-07-07T05:07:06.000000Z",
      "updated_at": "2020-07-07T05:07:17.000000Z"
    },
     {
      "id": "302e1ee7-8235-495e-a49d-758e3a220e92",
      "name": "João Teste",
      "email": "joao@teste.com",
      "phone": "99999999999",
      "level": "F",
      "external_id": "5f0403ad815004124b47da40",
      "created_at": "2020-07-07T06:08:25.000000Z",
      "updated_at": "2020-07-07T06:08:25.000000Z"
    }
  ],
  "first_page_url": "http:\/\/localhost:8000\/users?page=1",
  "from": 2,
  "last_page": 1,
  "last_page_url": "http:\/\/localhost:8000\/users?page=1",
  "next_page_url": null,
  "path": "http:\/\/localhost:8000\/users",
  "per_page": 10,
  "prev_page_url": null,
  "to": 2,
  "total": 2
}
```
OBS.: Use o query parameter **page** para navegar entre as páginas.


### Upgrade/Downgrade
Para realizar upgrade/downgrade de um usuário basta fazer uma requisição **PUT** para a rota **/users/id_do_usuário/upgrade** ou **/users/id_do_usuário/downgrade**.

### Frontend
Para acessar o frontend da aplicação vá até a rota **/home**.

# Autor

### [Frederico Sousa](http://github.com/fredericosousa)
<!-- 
# Licença

### [MIT](https://choosealicense.com/licenses/mit/) -->
