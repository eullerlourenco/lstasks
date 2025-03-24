# LSTasks 🚀✅

&#x20;&#x20;

LSTasks é um gerenciador de tarefas que permite criar, editar e organizar suas atividades de forma simplificada e eficiente. O projeto oferece suporte a tarefas com datas fixas ou recorrentes, gerenciamento de múltiplos usuários e recursos de autenticação seguros.

<div style="text-align: center;">
    <img src="https://github.com/eullerlourenco/lstasks/blob/df071601c95bf8cfa9121603f9ae11e3f2bb8fc4/docs/lstasks-home.png" alt="Home" width="500" />
    <img src="https://github.com/eullerlourenco/lstasks/blob/df071601c95bf8cfa9121603f9ae11e3f2bb8fc4/docs/lstasks-login.png" alt="Login" width="500" />
    <img src="https://github.com/eullerlourenco/lstasks/blob/df071601c95bf8cfa9121603f9ae11e3f2bb8fc4/docs/lstasks-edit.png" alt="Edit" width="500" />
    <img src="https://github.com/eullerlourenco/lstasks/blob/df071601c95bf8cfa9121603f9ae11e3f2bb8fc4/docs/lstasks-profile.png" alt="Profile" width="500" />
</div>

## ✨ Tecnologias Utilizadas

- **Laravel**: Framework PHP para desenvolvimento backend.
- **Laravel Sail**: Ambiente de desenvolvimento baseado em Docker.
- **Laravel Fortify**: Gerenciamento de autenticação (login, registro, recuperação de senha).
- **Blade Components**: Reutilização de componentes na interface.
- **Tailwind CSS**: Estilização moderna e responsiva.
- **JavaScript**: Funcionalidades dinâmicas no frontend.
- **Docker**: Contêinerização do projeto para facilitar a execução.

## 🔥 Funcionalidades

- **Autenticação completa** com Fortify (login, registro, recuperação de senha).
- **Gerenciamento de tarefas (CRUD)**:
  - Criar, visualizar, editar e excluir tarefas.
  - Definição de datas fixas ou recorrentes.
  - Marcar tarefas como concluídas ou reverter a conclusão.
- **Pesquisa e filtro** de tarefas para melhor organização.
- **Gerenciamento de usuário**:
  - Edição de informações básicas do usuário.
  - Segurança com Fortify.

## ⚙️ Instalação e Configuração

### 📌 Requisitos

- Docker e Docker Compose
- PHP 8+
- Composer
- Node.js & npm

### 🚀 Passos para Instalação

1. Clone o repositório:

   ```sh
   git clone https://github.com/eullerlourenco/lstasks.git
   cd lstasks
   ```

2. Copie o arquivo de exemplo de configuração:

   ```sh
   cp .env.example .env
   ```

3. Inicie os contêineres Docker com Laravel Sail:

   ```sh
   ./vendor/bin/sail up -d
   ```

4. Instale as dependências do projeto:

   ```sh
   composer install
   npm install && npm run dev
   ```

5. Gere a chave da aplicação:

   ```sh
   php artisan key:generate
   ```

6. Execute as migrações e seeders para popular o banco:

   ```sh
   php artisan migrate --seed
   ```

7. O projeto estará disponível em `http://localhost`.

### 🛠 Usuário Padrão (Seeder)

Depois de rodar a "migrate", para o login inicial, utilize:

- **Email:** admin@email.com
- **Senha:** password

## 📜 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

