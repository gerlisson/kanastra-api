
# Boleto CSV Uploader

Este projeto é um desafio da tech squad da Kanastra. 
Api em Laravel que permite o upload e processamento de arquivos CSV contendo informações de boletos. Os dados são armazenados em um banco de dados, e o nome do arquivo CSV é registrado em uma tabela histórica.

## Funcionalidades

- Upload de arquivos CSV
- Processamento de grandes volumes de dados utilizando `Spatie\SimpleExcel\SimpleExcelReader`
- Registro do nome do arquivo no banco de dados para histórico
- API para listar boletos
- Fila de jobs para envio dos boletos por email

## Tecnologias Utilizadas

- PHP 8.1
- Laravel 11.x
- MySQL
- Docker
- `Spatie\SimpleExcel`

## Requisitos

- Docker
- Docker Compose

## Configuração do Ambiente

### Passo 1: Clonar o Repositório

```bash
git clone https://github.com/gerlisson/kanastra-api.git
cd kanastra-api
```

### Passo 2: Configurar o Docker

Certifique-se de que você tem o Docker e o Docker Compose instalados em sua máquina. Em seguida, crie e inicie os containers Docker:

```bash
docker-compose up -d
```

### Passo 3: Instalar Dependências

Acesse o container da aplicação e instale as dependências do Laravel:

```bash
docker exec -it container_name bash
composer install
```

### Passo 4: Configurar o Banco de Dados

Copie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente conforme necessário. Em seguida, execute as migrações para criar as tabelas no banco de dados:

```bash
php artisan migrate
```

### Passo 5: Gerar a Chave da Aplicação

```bash
php artisan key:generate
```

## Uso

### Endpoint de Upload de CSV

Para fazer upload de um arquivo CSV, envie uma requisição `POST` para `/api/upload-csv` com o arquivo no corpo da requisição. O CSV deve ter o seguinte formato:

```csv
name,governmentId,email,debtAmount,debtDueDate,debtId
John Doe,123456789,johndoe@example.com,1500,2023-12-31,1
Jane Doe,987654321,janedoe@example.com,2000,2023-11-30,2
```

### Endpoint de Listagem de Boletos

Para listar os boletos, envie uma requisição `GET` para `/api/boletos`.

### Endpoint de Listagem de Histórico

Para listar os boletos, envie uma requisição `GET` para `/api/historico`.

## Testes

Para rodar os testes, use o seguinte comando:

```bash
php artisan test
```

### Teste Unitário

O projeto inclui um teste unitário para verificar a funcionalidade de upload de CSV e o registro do nome do arquivo no banco de dados.

## Estrutura do Projeto

- `app/Http/Controllers/Api/BoletoController.php`: Controlador responsável pelo upload e processamento do CSV.
- `app/Http/Controllers/Api/HistoricoController.php`: Controlador responsável pelo histórico dos arquivos já processados.
- `app/Services/CsvProcessorService.php`: Serviço responsável pelo processamento do CSV.
- `app/Models/Boleto.php`: Modelo para a tabela `boletos`.
- `app/Models/Historico.php`: Modelo para a tabela `historicos`.
- `tests/Feature/BoletoControllerTest.php`: Testes para a funcionalidade de upload de CSV.
- `tests/Unit/CsvProcessorServiceTest.php`: Testes unitários para a funcionalidade de upload de CSV.

## Estrutura do Schedule cron

- `app/Console/Kernel.php`: Define os schedule da aplicação.
- `app/Console/Commands/SendBoletosEmails.php`: Cria as filas.
- `app/Jobs/SendEmail.php`: Simulação de envio de e-mail.

## Testes Schedule

Testar o Sistema de Filas:

```bash
php artisan queue:work
```

Executar o Command Manualmente para Teste:

```bash
php artisan send:boletos-emails
```

## Configuração aplicação frontend

Configuração da aplicação frontend compilado do React

Configure o host na sua maquina local

```bash
sudo nano /etc/hosts
```

```/etc/hosts
127.0.0.1 front.localhost
```

Acesse a aplicação frontend `http://front.localhost/`