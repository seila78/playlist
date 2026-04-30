<?php
require_once 'crud.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if ($id > 0) {
        try {
            delete($pdo, 'musicas', "id = $id");
        } catch (Exception $e) {
            die("Erro ao tentar excluir a música: " . $e->getMessage());
        }
    }

    header("Location: ../index.php");
    exit();
} else {
    header("Location: ../index.php");
    exit();
}
?>