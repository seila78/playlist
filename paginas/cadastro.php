<?php
require_once '../PHP/crud.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dadosNovaMusica = [
        'titulo'    => $_POST['titulo'],
        'autor'     => $_POST['autor'],
        'imagem'    => $_POST['imagem'],
        'duracao'   => $_POST['duracao'],
        'categoria' => $_POST['categoria']
    ];

    try {
        create($pdo, 'musicas', $dadosNovaMusica);
        header("Location: ../index.php"); 
        exit();
    } catch (Exception $e) {
        $erro = "Erro ao cadastrar a música: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Músicas</title>
    <link rel="stylesheet" href="../CSS/cadastro.css">
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
                <li><a href="../index.php" class="btn">cancelar</a></li>
            </ul>
        </nav>
    </header>

    <div class="form-container">
        <h1 class="titulo-cadastro">Adicionar Nova Música</h1>

        <?php if (isset($erro)): ?>
            <p class="mensagem-erro"><?php echo $erro; ?></p>
        <?php endif; ?>

        <form action="cadastro.php" method="POST" class="cadastro-form">
            <div class="input-group">
                <label for="titulo">Título da Música</label>
                <input type="text" id="titulo" name="titulo" placeholder="Ex: Bohemian Rhapsody" required>
            </div>

            <div class="input-group">
                <label for="autor">Autor / Artista</label>
                <input type="text" id="autor" name="autor" placeholder="Ex: Queen" required>
            </div>

            <div class="input-group">
                <label for="imagem">URL da Capa (Imagem)</label>
                <input type="url" id="imagem" name="imagem" placeholder="https://link-da-imagem.com/capa.jpg" required>
            </div>

            <div class="input-row">
                <div class="input-group">
                    <label for="duracao">Duração</label>
                    <input type="text" id="duracao" name="duracao" placeholder="Ex: 05:55" required>
                </div>

                <div class="input-group">
                    <label for="categoria">Categoria / Gênero</label>
                    <input type="text" id="categoria" name="categoria" placeholder="Ex: Rock Clássico" required>
                </div>
            </div>

            <button type="submit" class="btn-submit">Cadastrar Música</button>
        </form>
    </div>
</body>
</html>