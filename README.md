# 🔥 Pokedex da Resenha

Uma **Pokedex estilizada em Pixel Art**, feita em **Laravel, PHP, JS, HTML e CSS**, inspirada nas clássicas Pokédex dos jogos.  
Permite **listar Pokémons em páginas**, salvar **favoritos** no navegador e exibir sprites animados em estilo **GameBoy retrô**.  

---

## 🛠 Tecnologias utilizadas
- **Backend:** Laravel (PHP)  
- **Frontend:** HTML, CSS, JavaScript, Bootstrap 5  
- **API:** [PokéAPI](https://pokeapi.co/)  
- **Armazenamento de favoritos:** LocalStorage  

---

## 🎨 Funcionalidades
1. Listagem de Pokémons com **paginação** (20 por página).  
2. **Favoritos** salvos no navegador.  
3. Sprites animados em **Pixel Art** (GIFs).  
4. Interface retrô estilo **GameBoy**.  
5. Hover animado nos cards.  

---

## 🚀 Como rodar o projeto localmente

### Pré-requisitos
- PHP >= 8.x  
- Composer  
- Servidor local (XAMPP, Laragon, etc.)  
- Node.js e npm (opcional, caso queira adicionar assets)

### Passos
1. Clonar o repositório:
git clone https://github.com/Emanoel-Ribeiro/pokedex-da-resenha.git

Entrar na pasta do projeto:
cd pokedex-da-resenha

Instalar dependências do Laravel:
composer install

Copiar o arquivo .env.example para .env:
copy .env.example .env   # Windows
# ou
cp .env.example .env     # Linux/Mac

Gerar a chave do aplicativo:
php artisan key:generate

Rodar o servidor local:
php artisan serve

Acessar no navegador:
http://127.0.0.1:8000/pokedex
