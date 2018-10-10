<?php
    require 'inc/database.php';
    $id = null;
    if (!empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
    if (null === $id) {
        header('Location: index.php');
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare('SELECT * FROM usuarios where usuario_id = ?');
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
    require 'inc/header.php';
?>

<div class="container">
    <div class="row">
        <h3>Informações do Usuário</h3>
    </div>

    <div class="row">
        <div class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">Nome</label>
                <p class="checkbox col-sm-6">
                    <?php echo $data['nome'];?>
                </p>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <p class="checkbox col-sm-6">
                    <?php echo $data['email'];?>
                </p>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Telefone</label>
                <p class="checkbox col-sm-6">
                    <?php echo $data['telefone'];?>
                </p>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <a class="btn btn-default" href="index.php">VOLTAR</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'inc/footer.php'; ?>