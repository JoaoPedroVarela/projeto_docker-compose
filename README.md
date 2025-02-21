# Documentação
Este projeto é um exemplo prático para quem está começando a trabalhar com Docker. Ele demonstra como containerizar uma aplicação simples que integra um front-end em PHP com uma API em Node.js. O objetivo é fornecer um ambiente de desenvolvimento isolado e fácil de reproduzir, utilizando Docker Compose para orquestrar os containers.
---

#### **O que tem no projeto?**
1. **Front-end**: Uma página em PHP que mostra uma lista de jogos.
2. **Back-end**: Uma API em Node.js que fornece os dados dos jogos.
3. **Docker**: Tudo está containerizado para rodar fácil em qualquer máquina.

---

#### **Como rodar o projeto?**
1. **Clone o repositório**:
   ```bash
   git clone https://github.com/JoaoPedroVarela/projeto_docker-compose.git
   cd projeto_docker-compose
   ```

2. **Suba os containers em segundo plano**:
   ```bash
   docker-compose up -d
   ```

3. **Acesse o json da api**:
  Abra o navegador e vá para:
   ```
   http://localhost:9001/jogos
   ```
   
4. **Acesse o front-end**:
   Abra o navegador e vá para:
   ```
   http://localhost:8888
   ```

5. **Parar os containers**:
   ```bash
   docker-compose down
   ```

---

#### **Tecnologias usadas**
- **PHP**: Front-end.
- **Node.js**: API.
- **MySql**: Banco de dados.
- **Docker**: Containers.
- **Docker Compose**: Gerenciamento dos containers.

---

#### **Estrutura do Projeto**
```
projeto_docker-compose/
├── api/                  # Pasta da API em Node.js
│   ├── db/               # Scripts do banco de dados
│   │   └── script.sql    # Script SQL para inicialização do banco
│   ├── node_modules/     # Módulos do Node.js (gerado automaticamente)
│   ├── src/              # Código fonte da API
│   │   └── index.js      # Arquivo principal da API
│   ├── website/          # Código do front-end em PHP
│   │   └── index.php     # Arquivo principal do front-end
│   ├── Dockerfile        # Configuração do container Node.js
│   ├── package.json      # Dependências e scripts do Node.js
│   └── package-lock.json # Versões exatas das dependências (gerado automaticamente)
├── docker-compose.yml    # Configuração dos containers
└── README.md             # Esta documentação
```

---

#### **Explicação do `docker-compose.yml`**
O arquivo `docker-compose.yml` define como os containers serão configurados e como eles se comunicam. Aqui está o que cada parte faz:

```yaml
version: '3.7'

services:
  db:
    image: mysql  # Usa a imagem oficial do MySQL
    container_name: mysql-container  # Nome do container
    environment:
      MYSQL_ROOT_PASSWORD: 123456  # Senha do root do MySQL
    volumes:
      - mysql-data:/var/lib/mysql  # Persiste os dados do MySQL
      - ./api/db/script.sql:/docker-entrypoint-initdb.d/script.sql  # Executa script SQL ao iniciar
    networks:
      - minha-rede  # Conecta à rede "minha-rede"
    healthcheck:
      test: ["CMD", "mysqladmin", "ping", "-h", "localhost"]  # Verifica se o MySQL está saudável
      interval: 5s
      timeout: 10s
      retries: 5

  api:
    build:
      context: "./api"  # Constrói a imagem da API a partir do Dockerfile da pasta "api"
    container_name: node-container  # Nome do container
    restart: always  # Reinicia automaticamente se cair
    volumes:
       - ./api:/home/node/app  # Sincroniza o código da API com o container
    networks:
      - minha-rede  # Conecta à rede "minha-rede"
    ports:
      - "9001:9001"  # Expõe a porta 9001 da API
    depends_on:
      db:
        condition: service_healthy  # Só inicia após o MySQL estar saudável

  web:
    image: "php:7.2-apache"  # Usa a imagem oficial do PHP com Apache
    container_name: php-container  # Nome do container
    restart: always  # Reinicia automaticamente se cair
    volumes:
      - ./api/website:/var/www/html  # Sincroniza o código do front-end com o container
    networks:
      - minha-rede  # Conecta à rede "minha-rede"
    ports:
      - "8888:80"  # Expõe a porta 80 do Apache como 8888 no host
    depends_on:
      - db  # Depende do MySQL
      - api  # Depende da API

volumes:
  mysql-data:
    name: mysql-data  # Volume para persistir os dados do MySQL

networks:
  minha-rede:
    name: minha-rede  # Rede para conectar os containers
```

---

#### **Como contribuir?**
1. Faça um fork do projeto.
2. Crie uma branch com sua feature:
   ```bash
   git checkout -b minha-feature
   ```
3. Envie as alterações:
   ```bash
   git add .
   git commit -m "Minha nova feature"
   git push origin minha-feature
   ```
4. Abra um **Pull Request** no GitHub.

---

#### **Licença**
MIT. Use à vontade!

---
