# Desafio VOX
O desafio consistiu em criar duas aplicações, uma frontend, com Angular e outra backend, com Symfony.

A aplicação era para cadastro de um quadro societário, ou seja, cadastro de companias e sócios.

## Para iniciar a aplicação
Clone o repotório
```bash
git clone git@gitlab.com:maxrodrigues/vox-challange.git
```

A aplicação foi feita usado docker
```bash
docker-compose up -d --build
```

Gerando o banco de dados
```bash
docker exec -it php php bin/console doctrine:migrations:migrate
```

Populando o banco de dados com dados iniciais (Empresas)
```bash
docker exec -it php php bin/console doctrine:fixtures:load
```

## Documentação da API

#### Retorna todas as Empresas

```http
  GET /api/list/company
```

#### Retorna uma empresa

```http
  GET /api/company/${id}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `id`      | `integer` | **Obrigatório**. O ID da empresa cadastrada |

#### Cria uma nova empresa

```http
  POST /api/list/company
```
```json
{
  "company_name": "Rafael e Elias Pizzaria Delivery ME",
  "trade_name": "RE Pizzaria Delivery",
  "cnpj": "88943822000157",
  "phone": "27998311212",
  "email": "contato@rafaeleeliaspizzariadeliveryme.com.br",
  "partner": {
    "name": "Opal Sawayn III", 
    "email": "Creola36@example.org",
    "phone": "(746) 826-8506 x8241",
    "cpf": "28420743003"
  }
}
```

#### Atualiza dos dados de uma empresa

```http
  PUT /api/company/${id}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `id`      | `integer` | **Obrigatório**. O ID da empresa cadastrada |

```json
{
  "company_name": "Rafael e Elias Pizzaria Delivery ME",
  "trade_name": "RE Pizzaria Delivery",
  "cnpj": "88943822000157",
  "phone": "27998311212",
  "email": "contato@rafaeleeliaspizzariadeliveryme.com.br"
}
```

#### Atualiza o status de uma empresa

```http
  PATCH /api/company/status/${id}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `id`      | `integer` | **Obrigatório**. O ID da empresa cadastrada |

```json
{
  "status": true // or false
}
```

#### Remove uma empresa

```http
  DELETE /api/company/${id}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `id`      | `integer` | **Obrigatório**. O ID da empresa cadastrada |

#### Cria um novo sócio

```http
  POST /api/partner/create
```
```json
{
  "name": "Marvin Oberbrunner",
  "email": "Gina.Carter61@example.com",
  "phone": "1-907-404-7878 x2404",
  "cpf": "28420743003"
}
```

#### Atualiza os dados do sócio

```http
  PUT /api/partner/${id}
```
| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `id`      | `integer` | **Obrigatório**. O ID do sócio cadastrada |

```json
{
  "name": "Marvin Oberbrunner",
  "email": "Gina.Carter61@example.com",
  "phone": "1-907-404-7878 x2404",
  "cpf": "28420743003"
}
```

#### Remove um sócio

```http
  DELETE /api/partner/${id}
```
| Parâmetro   | Tipo       | Descrição                                 |
| :---------- | :--------- |:------------------------------------------|
| `id`      | `integer` | **Obrigatório**. O ID do sócio cadastrada |

## Considerações Finais
O desafio de código foi, de fato, um grande desafio. Foi a primeira vez que trabalhei com Symfony — confesso que imaginei algo mais parecido com o Laravel, mas ele tem suas particularidades. Felizmente, a documentação foi uma grande aliada. Gastei um tempo precioso pensando em como melhorar algumas coisas, quando talvez o simples teria sido o suficiente.

O frontend foi um capítulo à parte. Já faz bastante tempo que não mexo com Angular, e frontend nunca foi meu ponto forte. Achei que conseguiria resolver essa parte rapidamente, mas me enganei feio. Acabei travando em um problema de CORS e não consegui avançar.

De qualquer forma, agradeço muito pelo desafio (pretendo continuar o projeto no GitHub) e pela oportunidade de codar um pouco para que vocês pudessem conhecer meu trabalho.

Um grande abraço!