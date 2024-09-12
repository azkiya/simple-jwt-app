
# Simple JWT Auth App (Laravel)
Mini project for crud package and implementation jwt
[Article Medium](https://medium.com/@azkiya/implementasi-jwt-menggunakan-model-enkripsi-asimetris-di-laravel-83e61fb03644)
## Run Locally

Clone the project

```bash
  git clone https://github.com/azkiya/simple-jwt-app
```

Go to the project directory

```bash
  cd simple-jwt-app
```

Install dependencies

```bash
  composer install
```

Setting environment

```bash
  create file .env minimal require from env.example & create DB 
```

Migration

```bash
  php artisan migrate
```

Run seeder

```bash
  php artisan db:seed
```

Run Generate Key

```bash
  php artisan key:generate
```

Start the server

```bash
  php artisan serve
```

### End Point
list of end point

| task | method|end point |
| ------ | ------ | ------ |
| register  | GET | [localhost:8000/api/register] |
| login | POST | [localhost:8000/api/login] |
| list packages | GET | [localhost:8000/api/packages] |
| detail packages | GET | [localhost:8000/api/packages/{:id}] |
| create packages | POST | [localhost:8000/api/packages] |
| update packages | PUT | [localhost:8000/api/packages/{:id}] |
| delete packages | DELETE | [localhost:8000/api/packages/{:id}] |

## Tech Stack

**Server:** PHP

**Framework** Laravel 11

## Authors

- [@fany](https://github.com/azkiya)

## Documentation
- [Jwt lcobucci](https://lcobucci-jwt.readthedocs.io/en/latest)
