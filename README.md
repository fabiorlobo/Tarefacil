[![Tarefácil](https://tarefacil.wowf.com.br/public/assets/images/logo.svg)](https://tarefacil.wowf.com.br)

# Instruções

Olá! Tudo certo?

Aqui vão algumas instruções para a manutenção deste projeto.

## Instalação

Este template utiliza webpack e algumas dependências. Confira os arquivos `package.json` e `webpack.config.js` caso tenha dúvidas.

Para fazer a instalação, você deve colocar estes arquivos na raiz do servidor.

Em seu terminal em ambiente local, dê o comando `npm install` para que as dependências sejam instaladas. Já em ambiente local como também de produção, o comando `composer install --no-interaction --optimize-autoloader --no-dev` instala as demais dependências do projeto.

Por fim, utilize os comandos `php artisan config:cache`, `php artisan route:cache` e `php artisan view:cache` quando fizer alterações no projeto.

## Estrutura

O Laravel tem a seguinte estrutura de pastas:

* `app`: Contém a lógica de negócio, incluindo os controllers, models, e middleware.
	* `app/Helpers`: Contém classes ou funções auxiliares globais da aplicação.
	* `app/Http`: Inclui os controllers, middleware, e form requests.
		* `app/Http/Controllers`: Armazena os controllers da aplicação.
		* `app/Http/Middleware`: Middleware da aplicação.
	* `app/Models`: Contém os modelos Eloquent usados para interagir com o banco de dados.
	* `app/Policies`: Armazena as políticas de autorização da aplicação.
	* `app/Providers`: Contém os provedores de serviço da aplicação, responsáveis por bootstrapping de diversos componentes.
* `bootstrap`: Contém os arquivos de inicialização da aplicação, como o autoloader e o arquivo `app.php`.
* `config`: Armazena os arquivos de configuração da aplicação, como configuração de banco de dados, e-mail e autenticação.
* `database`: Contém as migrations, factories e seeders para a base de dados.
	* `database/migrations`: Define a estrutura de banco de dados.
	* `database/factories`: Usado para criar dados falsos para testes.
	* `database/seeders`: Preenche a base de dados com dados de exemplo.
* `public`: Pasta pública que contém os arquivos acessíveis, como imagens, JavaScript e CSS compilado.
* `resources`: Contém as views e os assets não compilados (como CSS, JavaScript e imagens).
	* `resources/views`: Armazena os templates Blade (arquivos .blade.php).
	* `resources/assets`: Contém os arquivos de estilo e scripts antes da compilação.
* `routes`: Define as rotas da aplicação.
* `storage`: Contém logs, cache, e arquivos gerados pela aplicação.
	* `storage/app`: Contém arquivos carregados pela aplicação.
	* `storage/logs`: Armazena os arquivos de log.
	* `storage/framework`: Armazena arquivos gerados pelo framework, como cache e sessões.
* `tests`: Contém os testes automatizados da aplicação.
* `vendor`: Contém os pacotes do Composer.

---

**Tarefácil - Projeto de Pós-graduação Lato Sensu em Desenvolvimento Web Full Stack**

Criado por Fabio Lobo 
contato@fabiolobo.com.br  
[www.fabiolobo.com.br](https://www.fabiolobo.com.br)  

[![Fabio Lobo](https://www.fabiolobo.com.br/wp-content/themes/fl6.0/assets/images/logo.svg)](https://www.fabiolobo.com.br)