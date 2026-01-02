# TCC Plataforma Intelecto – Sistema Digital de Conteúdos e Exercícios Educacionais
📌 ## SOBRE O PROJETO

Este projeto foi desenvolvido como Trabalho de Conclusão de Curso (TCC) do Ensino Médio Técnico, com o objetivo de criar uma plataforma digital educacional para a rede de cursinhos Intelecto, e tem como finalidade:

-disponibilizar conteúdos escolares digitais
-Oferecer listas de exercícios para os alunos
-Centralizar o acesso a materiais didáticos em um ambiente online
-Auxiliar no processo de ensino-aprendizagem de forma prática e acessível

O sistema foi desenvolvido utilizando Laravel (PHP) no backend, Bootstrap e CSS no frontend, PostgreSQL como banco de dados e conta com uma funcionalidade complementar desenvolvida em Python para processamento específico.



##🛠️ TECNOLOGIAS UTILIZADAS

 -PHP 8.x
 -Laravel
 -Composer
 -Bootstrap
 -CSS
 -PostgreSQL
 -pgAdmin 4
 -Python 3.x



##⚙️ PRÉ-REQUISITOS

-PHP 8.x
-Composer
-PostgreSQL
-pgAdmin 4
-Python 3.x
-Git




##🚀 COMO EXECUTAR

1️⃣ Clonar o repositório
```bash
git clone https://github.com/materoo/TCC_Intelecto.git
cd TCC
```
Ou apenas extraia o projeto caso esteja em formato .zip.



2️⃣ Instalar dependências do Laravel
composer install



3️⃣ Configurar o ambiente

Crie o arquivo .env:
```bash
cp .env.example .env
```

Configure o banco de dados PostgreSQL no .env:
```bash
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=intelecto
DB_USERNAME=postgres
DB_PASSWORD=sua_senha
```


Gere a chave da aplicação:
```bash
php artisan key:generate
```


4️⃣ Criar o banco de dados

No pgAdmin 4:

-Abra o pgAdmin
-Conecte ao servidor PostgreSQL
-Crie um banco de dados com o nome configurado no .env



5️⃣ Executar as migrações
```bash
php artisan migrate
```


6️⃣ Executar o servidor Laravel
```bash
php artisan serve
```


A aplicação estará disponível em:

http://127.0.0.1:8000



🐍 Funcionalidade em Python

O projeto possui uma funcionalidade desenvolvida em Python, utilizada para processamento complementar de dados.

O script Python é executado a partir do backend Laravel, por meio de comandos do sistema operacional.

Para garantir o funcionamento:
```bash
python --version
```


Como o script utilize bibliotecas externas, instale-as com:
```bash
pip install -r requirements.txt
```



##👨‍💻 AUTORES

Gabriel Iamato
Guilherme Tvares
Gustavo Rocha
Marcela Amorim
Mateus Juares Felipe
Matheus Stolf Eberle
Murilo Gonzales Vieira

Projeto desenvolvido como TCC do Ensino Médio Técnico.
