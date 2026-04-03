# Laravel AI Local

Projeto Laravel 13 com integração de IA local via **Laravel AI** e autenticação JWT.

## 🚀 Recursos

- **Autenticação JWT** - Login, registro, refresh e logout de usuários
- **IA Local com Ollama** - Assistente local integrado com tools personalizadas
- **API RESTful** - Endpoints para autenticação e interação com IA
- **Tools Disponíveis**:
  - `CalculatorTool` - Cálculos matemáticos simples
  - `CurrentDateTimeTool` - Data e hora atuais
  - `RandomNumberTool` - Geração de números aleatórios

## 📋 Requisitos

- PHP 8.3+
- Composer
- Node.js & NPM
- Ollama instalado com modelo `qwen2.5:3b`

## ⚙️ Instalação

```bash
# Clonar repositório
git clone <repository-url>
cd laravel-ai-local

# Instalar dependências PHP
composer install

# Copiar arquivo de ambiente
cp .env.example .env

# Gerar chave da aplicação
php artisan key:generate

# Instalar dependências JavaScript
npm install

# Rodar migrações
php artisan migrate

# Compilar assets
npm run build
```

## 🔑 Configuração JWT

```bash
php artisan jwt:secret
```

## 🏃‍♂️ Executando o Projeto

```bash
# Terminal 1 - Servidor de desenvolvimento
php artisan serve

# Terminal 2 - Queue worker (opcional)
php artisan queue:work

# Terminal 3 - Vite dev server
npm run dev
```

## 📡 Endpoints da API

### Autenticação

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| POST | `/api/register` | Registrar novo usuário |
| POST | `/api/login` | Login e obtenção de token |
| GET | `/api/me` | Dados do usuário autenticado |
| POST | `/api/refresh` | Refresh do token JWT |
| POST | `/api/logout` | Logout (invalidar token) |

### IA

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| POST | `/api/ai/test` | Enviar mensagem para o assistente local |

## 📝 Exemplos de Uso

### Registrar Usuário

```bash
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "João Silva",
    "email": "joao@example.com",
    "password": "senha123"
  }'
```

### Login

```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "joao@example.com",
    "password": "senha123"
  }'
```

### Usar a IA

```bash
curl -X POST http://localhost:8000/api/ai/test \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer {token}" \
  -d '{
    "mensagem": "Que horas são?"
  }'
```

## 🗂️ Estrutura do Projeto

```
app/
├── Ai/
│   ├── Agents/
│   │   └── AssistenteLocal.php    # Agente de IA configurado
│   └── Tools/
│       ├── CalculatorTool.php     # Tool de cálculos
│       ├── CurrentDateTimeTool.php # Tool de data/hora
│       └── RandomNumberTool.php   # Tool de números aleatórios
├── Http/
│   └── Controllers/
│       └── Api/
│           ├── AuthController.php  # Autenticação
│           └── AiTestController.php # Endpoint de IA
└── Models/
    └── User.php
```

## 🧪 Testes

```bash
composer test
```

## 🛠️ Comandos Úteis

```bash
# Limpar caches
php artisan optimize:clear

# Listar rotas
php artisan route:list

# Debug do config
php artisan config:cache
```

## 📄 Licença

Este projeto é open-source sob a licença [MIT](https://opensource.org/licenses/MIT).

---

<div align="center">
  <p>Desenvolvido com Laravel 13 + Laravel AI + JWT</p>
</div>
