<?php
require_once '../PHP/crud.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$musica = null;

if ($id > 0) {
    $musica = read($pdo, 'musicas', "id = $id");
}

if (!$musica && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("<div style='color:white; text-align:center; margin-top:50px;'>
            <h1>Música não encontrada!</h1>
            <a href='../index.php' style='color:#14c204;'>Voltar para a playlist</a>
         </div>");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idAtualizar = $_POST['id'];
    
    $dadosAtualizados = [
        'titulo'    => $_POST['titulo'],
        'autor'     => $_POST['autor'],
        'imagem'    => $_POST['imagem'],
        'duracao'   => $_POST['duracao'],
        'categoria' => $_POST['categoria']
    ];

    try {
        update($pdo, 'musicas', $dadosAtualizados, "id = $idAtualizar");
        header("Location: ../index.php"); 
        exit();
    } catch (Exception $e) {
        $erro = "Erro ao atualizar a música: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Música</title>
    <link rel="stylesheet" href="../CSS/editar.css">
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
        <h1 class="titulo-cadastro">Editar Música (ID: <?php echo $musica['id']; ?>)</h1>

        <?php if (isset($erro)): ?>
            <p class="mensagem-erro"><?php echo $erro; ?></p>
        <?php endif; ?>

        <form action="editar.php" method="POST" class="cadastro-form">
            <input type="hidden" name="id" value="<?php echo $musica['id']; ?>">

            <div class="input-group">
                <label for="titulo">Título da Música</label>
                <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($musica['titulo']); ?>" required>
            </div>

            <div class="input-group">
                <label for="autor">Autor / Artista</label>
                <input type="text" id="autor" name="autor" value="<?php echo htmlspecialchars($musica['autor']); ?>" required>
            </div>

            <div class="input-group">
                <label for="imagem">URL da Capa (Imagem)</label>
                <input type="url" id="imagem" name="imagem" value="<?php echo htmlspecialchars($musica['imagem']); ?>" required>
            </div>

            <div class="input-row">
                <div class="input-group">
                    <label for="duracao">Duração</label>
                    <input type="text" id="duracao" name="duracao" value="<?php echo htmlspecialchars($musica['duracao']); ?>" required>
                </div>

                <div class="input-group">
                    <label for="categoria">Categoria / Gênero</label>
                    <input type="text" id="categoria" name="categoria" value="<?php echo htmlspecialchars($musica['categoria']); ?>" required>
                </div>
            </div>

            <button type="submit" class="btn-submit">Atualizar Música</button>
        </form>
    </div>
</body>
</html>