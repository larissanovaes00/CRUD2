<?php
    require 'inc/database.php';

    $id = null;
    if (!empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    if (null === $id) {
        header('Location: index.php');
    }

    if (!empty($_POST)) {
        $nameError = null;
        $emailError = null;
        $mobileError = null;

        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];

        $valid = true;

        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }

        if (empty($email)) {
            $emailError = 'Please enter Email Address';
            $valid = false;
        } else if ( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Please enter a valid Email Address';
            $valid = false;
        }

        if (empty($mobile)) {
            $mobileError = 'Please enter Mobile Number';
            $valid = false;
        }

        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $q = $pdo->prepare('UPDATE usuarios set nome = ?, email = ?, telefone = ? WHERE usuario_id = ?');
            $q->execute(array($name, $email, $mobile, $id));
            Database::disconnect();
            header('Location: index.php');
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare('SELECT * FROM usuarios where usuario_id = ?');
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $name = $data['nome'];
        $email = $data['email'];
        $mobile = $data['telefone'];
        Database::disconnect();
    }

    require 'inc/header.php';
?>

<div class="container">
    <div class="row">
        <h3>Atualizar usuario <?php echo !empty($name) ? $name : ''; ?> </h3>
    </div>

    <div class="row">
        <form class="form-horizontal" action="update.php?id=<?php echo $id; ?>" method="post">
            <div class="form-group <?php echo !empty($nameError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 control-label">Nome</label>
                <div class="controls col-sm-6">
                    <input class="form-control" name="name" type="text" placeholder="Name" value="<?php echo !empty($name) ? $name : ''; ?>">
                    <?php if (!empty($nameError)): ?>
                        <span class="help-inline"><?php echo $nameError;?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group <?php echo !empty($emailError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 control-label">Email</label>
                <div class="controls col-sm-6">
                    <input class="form-control" name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email) ? $email : ''; ?>">
                    <?php if (!empty($emailError)): ?>
                        <span class="help-inline"><?php echo $emailError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="form-group <?php echo !empty($mobileError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 control-label">Telefone</label>
                <div class="controls col-sm-6">
                    <input class="form-control" name="mobile" type="text" placeholder="Mobile Number" value="<?php echo !empty($mobile) ? $mobile : ''; ?>">
                    <?php if (!empty($mobileError)): ?>
                        <span class="help-inline"><?php echo $mobileError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">ATUALIZAR</button>
                    <a class="btn btn-default" href="index.php">VOLTAR</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require 'inc/footer.php'; ?>