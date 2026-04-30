<?php
require_once './PHP/crud.php';
$musicas = readAll($pdo, 'musicas');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Playlist</title>
    <link rel="stylesheet" href="./CSS/style.css">
</head>
<body>
    <header> 
        <nav class="navbar">
            <div class="logo">
                <a href="index.html">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/c/c5/Melon_logo.png" alt="Logo da FullTech" class="logo-img">
                </a>
            </div>
            <ul class="nav-links">
                <li><a href="./paginas/editar.php" class="btn" onclick="abrirModal(event)">Editar</a></li>
                <li><a href="#" class="btn" onclick="abrirModalExcluir(event)">Apagar</a></li>
                <li><a href="./paginas/cadastro.php" class="btn">Cadastro</a></li>
            </ul>
        </nav>
    </header>

    <h1 class="titulo">Minha Playlist Pessoal</h1>

    <div class="main-content">
        <div class="playlist-section">
            <table class="playlist">
                <tr>
                    <th>ID</th>
                    <th>Capa</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Duração</th>
                    <th>Categoria</th>
                </tr>
                <?php
                foreach ($musicas as $musica) {
                    echo "<tr>";
                    echo "<td>{$musica['id']}</td>";
                    echo "<td><img src='{$musica['imagem']}' alt='Capa' width='50' style='border-radius:5px;'></td>";
                    echo "<td>{$musica['titulo']}</td>";
                    echo "<td>{$musica['autor']}</td>";
                    echo "<td>{$musica['duracao']}</td>";
                    echo "<td>{$musica['categoria']}</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>

        <div class="player-section">
            <h3 class="player-header">Music Player</h3>
            <svg viewBox="0 0 24 24" class="nota-musical">
                <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
            </svg>
            
            <h2 class="player-title">Título da Música</h2>
            <h4 class="player-author">Autor</h4>

            <div class="player-controls">
                <svg viewBox="0 0 24 24" class="icon"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                
                <svg viewBox="0 0 24 24" class="icon"><path d="M6 6h2v12H6zm3.5 6l8.5 6V6z"/></svg>
                
                <svg viewBox="0 0 24 24" class="icon icon-large"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                
                <svg viewBox="0 0 24 24" class="icon"><path d="M6 18l8.5-6L6 6v12zM16 6v12h2V6h-2z"/></svg>
                
                <svg viewBox="0 0 24 24" class="icon"><path d="M7 11v2h10v-2H7zm5-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
            </div>

            <div class="progress-bar">
                <svg width="100%" height="20" viewBox="0 0 300 20" preserveAspectRatio="none">
                    <line x1="0" y1="10" x2="300" y2="10" stroke="#333" stroke-width="4" stroke-linecap="round"/>
                    <line x1="0" y1="10" x2="200" y2="10" stroke="#14c204" stroke-width="4" stroke-linecap="round"/>
                    <circle cx="200" cy="10" r="6" fill="#14c204" />
                </svg>
            </div>
        </div>
    </div>
    <div id="modalEditar" class="modal">
        <div class="modal-content">
            <span class="close" onclick="fecharModal()">&times;</span>
            <h2 style="color: #14c204; margin-bottom: 20px;">Editar Música</h2>
            <form action="./paginas/editar.php" method="GET">
                <label for="edit_id" style="color: #aaa;">Digite o ID da Música:</label>
                <input type="number" id="edit_id" name="id" required style="width: 80%; padding: 10px; margin-top: 10px; background-color: #282828; color: #fff; border: 1px solid #444; border-radius: 5px; border-bottom: 2px solid #14c204; font-size: 16px;">
                <button type="submit" class="btn-submit" style="width: 100%; margin-top: 20px; padding: 10px; background-color: #14c204; border: none; border-radius: 20px; font-weight: bold; cursor: pointer;">Buscar e Editar</button>
            </form>
        </div>
    </div>

    <div id="modalExcluir" class="modal">
        <div class="modal-content" style="border-top: 5px solid #ff4c4c;">
            <span class="close" onclick="fecharModalExcluir()">&times;</span>
            <h2 style="color: #ff4c4c; margin-bottom: 10px;">Excluir Música</h2>
            <p style="color: #aaaaaa; margin-bottom: 20px; font-size: 14px;">Atenção: Esta ação não pode ser desfeita. Tem certeza que deseja remover a música?</p>
            
            <form action="./PHP/excluir.php" method="POST">
                <label for="delete_id" style="color: #aaa; text-align: left; display: block;">Digite o ID da Música:</label>
                <input type="number" id="delete_id" name="id" required style="width: 100%; padding: 12px; margin-top: 10px; background-color: #282828; color: #fff; border: 1px solid #444; border-radius: 5px; outline: none;">
                
                <button type="submit" class="btn-submit" style="width: 100%; margin-top: 20px; padding: 12px; background-color: #ff4c4c; color: white; border: none; border-radius: 20px; font-weight: bold; font-size: 16px; cursor: pointer; transition: background 0.3s;">
                    Sim, Excluir Música
                </button>
            </form>
        </div>
    </div>

    <script>
        function abrirModal(e) {
            e.preventDefault();
            document.getElementById('modalEditar').style.display = 'flex';
        }

        function fecharModal() {
            document.getElementById('modalEditar').style.display = 'none';
        }

        window.onclick = function(event) {
            var modal = document.getElementById('modalEditar');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function abrirModal(e) {
            e.preventDefault();
            document.getElementById('modalEditar').style.display = 'flex';
        }
        function fecharModal() {
            document.getElementById('modalEditar').style.display = 'none';
        }
        
        function abrirModalExcluir(e) {
            e.preventDefault();
            document.getElementById('modalExcluir').style.display = 'flex';
        }
        function fecharModalExcluir() {
            document.getElementById('modalExcluir').style.display = 'none';
        }

        window.onclick = function(event) {
            var modalEdit = document.getElementById('modalEditar');
            var modalExcluir = document.getElementById('modalExcluir');
            
            if (event.target == modalEdit) {
                modalEdit.style.display = "none";
            }
            if (event.target == modalExcluir) {
                modalExcluir.style.display = "none";
            }
        }
    </script>
</body>
</html>