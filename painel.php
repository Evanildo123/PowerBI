<?php

include('protect.php');

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard IT</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      display: flex;
      font-family: 'Roboto', sans-serif;
      background-color: #f0f2f5;
      color: #333;
      transition: all 0.3s ease;
    }

    /* Menu lateral */
    .menu {
      width: 250px;
      background-color: #1f1f1f;
      padding: 20px;
      color: #fff;
      height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      box-shadow: 4px 0 15px rgba(0, 0, 0, 0.2);
      transition: width 0.3s;
    }

    /* Menu recolhido */
    .menu.compacto {
      width: 80px;
      padding: 10px;
    }

    .menu h2 {
      font-weight: 700;
      font-size: 1.5em;
      margin-bottom: 30px;
      color: #ED196D;
      transition: opacity 0.3s;
    }

    .menu.compacto h2 {
      opacity: 0;
    }

    .menu a {
      display: block;
      width: 100%;
      padding: 12px 20px;
      margin: 10px 0;
      color: #fff;
      text-decoration: none;
      border-radius: 8px;
      font-weight: 500;
      background-color: #333;
      transition: background 0.3s, transform 0.2s, padding 0.3s;
      text-align: center;
      word-break: break-word;
    }

    .menu a:hover {
      background-color: #ED196D;
      transform: scale(1.05);
    }

    .menu.compacto a {
      padding: 12px;
      text-align: center;
    }

    /* Botão de recolher/expandir */
    .toggle-btn {
      cursor: pointer;
      margin-bottom: 20px;
      font-size: 1.2em;
      color: #ED196D;
      background: none;
      border: none;
      transition: transform 0.3s;
    }

    /* Área de conteúdo */
    .content {
      flex: 1;
      padding: 0;
      background-color: #fff;
      overflow-y: auto;
    }

    /* Estilos do iframe */
    .content iframe {
      width: 100%;
      height: 100vh;
      border: none;
    }

    .loading {
      font-size: 1.2em;
      color: #666;
      padding: 40px;
      text-align: center;
    }
  </style>
</head>
<body>

  <!-- Menu Lateral -->
  <div class="menu" id="menu">
    <button class="toggle-btn" onclick="toggleMenu()">&#9776;</button>
    <h2>DASHBOARD IT</h2>
    <a href="#" onclick="navigate('page1')">Equipamentos</a>
    <a href="#" onclick="loadContent('page2.html')">Página 2</a>
    <a href="#" onclick="loadContent('page3.html')">Página 3</a>
  </div>

  <!-- Área de Conteúdo -->
  <div class="content" id="content">
    <h3>Bem-vindo ao Dashboard IT</h3>
    <p>Selecione um dashboard no menu para carregar o conteúdo aqui.</p>
  </div>

  <script>
    // Função para carregar conteúdo dinamicamente
    function loadContent(page) {
      const contentDiv = document.getElementById('content');
      contentDiv.innerHTML = '<p class="loading">Carregando conteúdo...</p>';

      fetch(page)
        .then(response => response.text())
        .then(data => {
          contentDiv.innerHTML = data;
        })
        .catch(error => {
          contentDiv.innerHTML = '<p>Erro ao carregar o conteúdo.</p>';
          console.error("Erro ao carregar a página: ", error);
        });
    }

    // Função para alternar o menu entre compacto e expandido
    function toggleMenu() {
      const menu = document.getElementById('menu');
      menu.classList.toggle('compacto');
    }

    // Função para redirecionar ou carregar conteúdo
    function navigate(page) {
      const contentDiv = document.getElementById('content');

      if (page === 'page1') {
        contentDiv.innerHTML = `<iframe src="https://fast.com/pt/" title="Equipamentos"></iframe>`; // Carrega o link no iframe
      } else {
        loadContent(page + '.html'); // Carrega conteúdo interno
      }
    }
  </script>
</body>
</html>
