<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pokedex da Resenha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background: #a9a9a9; /* Cinza clássico de GameBoy */
            font-family: "Press Start 2P", cursive; /* Fonte retrô opcional */
        }
        .container {
            max-width: 1200px;
        }
        h1, h2 { 
            color: #222; 
            text-shadow: 2px 2px #fff;
        }
        .pokemon-card {
            transition: transform 0.2s;
            cursor: pointer;
            border: 4px solid #333; /* borda pixelada */
            border-radius: 4px;
            background: #c0c0c0; /* fundo tipo GameBoy */
            box-shadow: 4px 4px #888 inset;
        }
        .pokemon-card:hover {
            transform: scale(1.05);
            box-shadow: 4px 4px #666 inset;
        }
        .favorite {
            color: gold;
            font-size: 1.5rem;
            cursor: pointer;
        }
        .not-favorite {
            color: #333;
            font-size: 1.5rem;
            cursor: pointer;
        }
        img.pixel {
            image-rendering: pixelated;
        }
        .card-title {
            font-size: 1rem;
        }
        .card-body {
            padding: 0.5rem;
        }
        .pagination-buttons {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <div class="container text-center mt-5">
        <h1>🔥 Pokedex da Resenha 🔥</h1>

        <!-- Área dos cards -->
        <div id="pokemonList" class="row g-4 mt-4"></div>

        <!-- Paginação -->
        <div class="pagination-buttons">
            <button class="btn btn-dark" onclick="previousPage()">⬅️ Anterior</button>
            <button class="btn btn-dark" onclick="nextPage()">Próximo ➡️</button>
        </div>

        <!-- Favoritos -->
        <h2 class="mt-5">⭐ Favoritos</h2>
        <div id="favoritesList" class="row g-4"></div>
    </div>

    <script>
        let offset = 0;
        const limit = 20;
        let favorites = JSON.parse(localStorage.getItem('favorites')) || [];

        async function loadPokemons() {
            const resposta = await fetch(`https://pokeapi.co/api/v2/pokemon?offset=${offset}&limit=${limit}`);
            const data = await resposta.json();

            const container = document.getElementById('pokemonList');
            container.innerHTML = "";

            for (const pokemon of data.results) {
                const pokeData = await fetch(pokemon.url).then(res => res.json());

                // GIF Pixel Art animado
                let spriteGif = pokeData.sprites.versions['generation-v']['black-white'].animated.front_default;
                if (!spriteGif) {
                    spriteGif = pokeData.sprites.front_default;
                }

                container.innerHTML += createPokemonCard(pokeData, spriteGif);
            }

            renderFavorites();
        }

        function createPokemonCard(data, sprite) {
            const isFavorite = favorites.some(fav => fav.id === data.id);

            return `
                <div class="col-md-3">
                    <div class="card pokemon-card">
                        <img src="${sprite}" class="card-img-top pixel p-2" alt="${data.name}">
                        <div class="card-body text-dark">
                            <h5 class="card-title text-capitalize">${data.name}</h5>
                            <p>ID: ${data.id}</p>
                            <p>Tipo: ${data.types.map(t => t.type.name).join(', ')}</p>
                            <span class="${isFavorite ? 'favorite' : 'not-favorite'}"
                                  onclick="toggleFavorite(${data.id}, '${data.name}', '${sprite}')">
                                  ★
                            </span>
                        </div>
                    </div>
                </div>
            `;
        }

        function toggleFavorite(id, name, image) {
            const index = favorites.findIndex(fav => fav.id === id);
            if (index === -1) {
                favorites.push({ id, name, image });
            } else {
                favorites.splice(index, 1);
            }
            localStorage.setItem('favorites', JSON.stringify(favorites));
            loadPokemons();
        }

        function renderFavorites() {
            const container = document.getElementById('favoritesList');
            container.innerHTML = "";

            favorites.forEach(fav => {
                container.innerHTML += `
                    <div class="col-md-2">
                        <div class="card pokemon-card">
                            <img src="${fav.image}" class="card-img-top pixel p-2" alt="${fav.name}">
                            <div class="card-body text-dark">
                                <h6 class="card-title text-capitalize">${fav.name}</h6>
                                <small>ID: ${fav.id}</small>
                            </div>
                        </div>
                    </div>
                `;
            });
        }

        function nextPage() {
            offset += limit;
            loadPokemons();
        }

        function previousPage() {
            if (offset >= limit) {
                offset -= limit;
                loadPokemons();
            }
        }

        // carregar ao iniciar
        loadPokemons();
    </script>
</body>
</html>
k