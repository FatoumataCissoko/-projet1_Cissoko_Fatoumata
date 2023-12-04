<?php
include "../pageAccueil/Entete.php";
$users = getAllUsers();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = getUserById($id);
    if (isset($_POST['register'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $addresse = $_POST['addresse'];
        $postal_code = $_POST['postal_code'];
        $date_naissance = $_POST['date_naissance'];
        $roleU = $_POST['roleU'];
        if (
            !empty($nom) || !empty($prenom) || !empty($email) || !empty($addresse) || !empty($postal_code) || !empty($date_naissance) || !empty($roleU)
        ) {
            UpdateUser($id, $nom, $prenom, $email, $addresse, $postal_code, $date_naissance, $roleU);
        }
    }
}

?>

<section>
    <div class="registerfrm">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="login-container">
                        
                            <h3 class="mb-3">Edit Profile</h3>
                        
                        <hr>
                        <form method="post">
                            <div class="container">
                                <div class="mb-3">
                                    <label for="nom" class="form-label"><i class="bi bi-forward-fill"></i> <b>Last
                                            Name</b></label>
                                    <input type="text" name="nom" class="form-control" id="nom"
                                        value="<?php echo $user['nom']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="prenom" class="form-label"><i class="bi bi-forward-fill"></i> <b>First
                                            Name</b></label>
                                    <input type="text" name="prenom" class="form-control" id="prenom"
                                        value="<?php echo $user['prenom']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label"><i
                                            class="bi bi-envelope-at-fill"></i> <b>E-mail</b></label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                        value="<?php echo $user['email']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="addresse" class="form-label"><i class="bi bi-card-list"></i>
                                        <b>Address</b></label>
                                    <textarea class="form-control" name="addresse"
                                        rows="3"><?php echo $user['addresse']; ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="postal_code" class="form-label"><i class="bi bi-postcard-fill"></i>
                                        <b>Postal
                                            Code</b></label>
                                    <input type="text" name="postal_code" class="form-control"
                                        value="<?php echo $user['postal_code']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="date_naissance" class="form-label"><i class="bi bi-calendar-date"></i>
                                        <b>Date_naissance</b></label>
                                    <input type="date" name="date_naissance" class="form-control" id="date_naissance"
                                        value="<?php echo $user['date_naissance']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="roleU" class="form-label"><i class="bi bi-person-fill-lock"></i>
                                        <b>Role</b></label>
                                    <input type="text" name="roleU" class="form-control" id="roleU"
                                        value="<?php echo $user['roleU']; ?>">
                                </div>
                                <br>
                                
                                    <div class="mb-3">
                                        <button type="submit" name="register" class="btn btn-primary">Modifier</button>
                                    </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</main>

</body>

</html>