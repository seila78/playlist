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
        <nav>
            <ul class="navbar">
                <div class="logo">
                    <a href="index.html"><img src="https://upload.wikimedia.org/wikipedia/commons/c/c5/Melon_logo.png" alt="Logo da FullTech" class="logo"></a>
                </div>
                <div class="button">
                    <li class="button"><a href="#">Cadastro</a></li>
                </div>
                <div class="button">
                    <li class="button"><a href="#">Cadastro</a></li>
                </div>
                <div class="button">
                    <li class="button"><a href="#">Cadastro</a></li>
                </div>
            </ul>
        </nav>
    </header>
    <h1 class="titulo">Minha Playlist Pessoal</h1>
    <div class="container">
        <table class="playlist">
            <tr>
                <th>ID</th>
                <th>Capa</th>
                <th>Título</th>
                <th>autor</th>
                <th>duraço</th>
                <th>categoria</th>
            </tr>
            <?php
            require_once './PHP/crud.php';

            $musicas = readAll($pdo, 'musicas');
            foreach ($musicas as $musica) {
                echo "<tr>";
                echo "<td>{$musica['id']}</td>";
                echo "<td><img src='{$musica['imagem']}' alt='Capa da música' width='50'></td>";
                echo "<td>{$musica['titulo']}</td>";
                echo "<td>{$musica['autor']}</td>";
                echo "<td>{$musica['duracao']}</td>";
                echo "<td>{$musica['categoria']}</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>