FROM node:18-slim

# Define o diretório de trabalho
WORKDIR /home/node/app

# Copia o package.json e package-lock.json
COPY package*.json ./

# Instala as dependências
RUN npm install

# Copia o restante do código
COPY . .

# Expõe a porta 9001
EXPOSE 9001

# Comando para rodar a aplicação
CMD ["npm", "start"]