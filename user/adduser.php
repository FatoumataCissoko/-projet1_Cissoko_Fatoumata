<?php
include "../pageAccueil/Entete.php";
$users = getAllUsers();
?>

<!--display all users in the database on screen-->
<main>
    <section>
        <div class="registerfrm">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        
                            <h4>Liste des utilisateurs</h4>
                        
                        <hr>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($users as $user) {
                                    ?>
                                    <tr>
                                        <th scope="row">
                                            <?php echo $user['id']; ?>
                                        </th>
                                        <td>
                                            <?php echo $user['nom']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['prenom']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['email']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['roleU']; ?>
                                        </td>
                                        <td>
                                            <a href="editUser.php?id=<?php echo $user['id']; ?>"
                                                class="btn btn-info btn-sm">Modifier</a>
                                            <a href="deleteUser.php?id=<?php echo $user['id']; ?>"
                                                class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill">
                                                </i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
</body>

</html>