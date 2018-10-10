<?php require 'inc/header.php'; ?>

<div class="container">
    <div class="row">
        <h3>CRUD de Usuarios</h3>
    </div>

    <div class="row">
        <p><a href="create.php" class="btn btn-success">CRIAR NOVO USUARIO</a></p>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>EMAIL</th>
                    <th>TELEFONE</th>
                    <th>AÇÃO</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require 'inc/database.php';

                    $pdo = Database::connect();
                    $getCustomers = $pdo->prepare('SELECT * FROM usuarios ORDER BY usuario_id DESC');
                    $getCustomers->execute();

                    if($getCustomers->rowCount() > 0) {
                        while ($row = $getCustomers->fetch()) {
                            echo '<tr>';
                            echo '<td>'. $row['nome'] . '</td>' . PHP_EOL;
                            echo '<td>'. $row['email'] . '</td>' . PHP_EOL;
                            echo '<td>'. $row['telefone'] . '</td>' . PHP_EOL;
                            echo '<td>' . PHP_EOL;
                            echo '<a class="btn btn-default" href="read.php?id='.$row['usuario_id'].'">VISUALIZAR</a>' . PHP_EOL;
                            echo '<a class="btn btn-success" href="update.php?id='.$row['usuario_id'].'">ATUALIZAR</a>' . PHP_EOL;
                            echo '<a class="btn btn-danger" href="delete.php?id='.$row['usuario_id'].'">EXCLUIR</a>' . PHP_EOL;
                            echo '</td>' . PHP_EOL;
                            echo '</tr>' . PHP_EOL;
                        }
                    } else {
                        echo '<tr>';
                        echo '<td>Nada cadastrado</td>' . PHP_EOL;
                        echo '<td>Nada cadastrado</td>' . PHP_EOL;
                        echo '<td>Nada cadastrado</td>' . PHP_EOL;
                        echo '<td>Nada cadastrado</td>' . PHP_EOL;
                        echo '</tr>';
                    }

                    Database::disconnect();
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php require 'inc/footer.php'; ?>