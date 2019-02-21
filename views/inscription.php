<?php
require_once '../controllers/CTRLR_AddUser.php';
require_once '../controllers/CTRLR_AddMoto.php';
?>
<head>
    <meta charset="utf-8" />
    <title>Le Repaire de la Moto - Inscription</title>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- CSS -->
    <link rel="stylesheet" href="/assets/style.css" />
</head>
<!-- NAVBAR -->
<?php include('navbar.php'); ?>

<!-- CONTENT PAGE -->
<div class="content-wrap space">
    <div class="container margtop-2">
        <div class="row justify-content-center">
            <?php if ($addSuccess) { ?>
                <?php include('success.php'); ?>
            <?php } else {
                ?>

                <div class="col-sm-10 text-center">
                    <form class="grey lighten-1" name="form" id="profileForm" method="post" enctype="multipart/form-data">
                        <div class="card">

                            <!-- TITRE -->
                            <div class="card-header elegant-color-dark" role="tab" id="heading1">
                                <h2 class="mb-0 mt-3 grey-text">Inscription</h2>
                            </div>

                            <div class="card-body pt-0 grey lighten-1">
                                <h3 class="mb-0 mt-3 grey-text">Mon Profil</h3>

                                <!-- LASTNAME - FIRSTNAME - BIRTHDATE -->
                                <div class="form-row form-space">
                                    <div class="md-form col-md-4">
                                        <label for="inputLastname">Nom<span class="red-text"> <?= isset($arrayError['lastnameErr']) ? $arrayError['lastnameErr'] : ''; ?></span></label>
                                        <input class="form-control" id="inputLastname" type="text" name="inputLastname" value="<?= count($arrayError) != 0 ? $userOBJ->lastname : ''; ?>" />
                                    </div>
                                    <div class="md-form col-md-4">
                                        <label for="inputFirstname">Prénom<span class="red-text"> <?= isset($arrayError['firstnameErr']) ? $arrayError['firstnameErr'] : ''; ?></span></label>
                                        <input  class="form-control" id="inputFirstname" type="text" name="inputFirstname" value="<?= count($arrayError) != 0 ? $userOBJ->firstname : ''; ?>" />
                                    </div>
                                    <div class="md-form col-md-4">
                                        <label class="active" for="inputBirthdate">Date de naissance<span class="red-text"> <?= isset($arrayError['birthdateErr']) ? $arrayError['birthdateErr'] : ''; ?></span></label>
                                        <input class="form-control" id="inputBirthdate" type="date"  name="inputBirthdate" value="<?= count($arrayError) != 0 ? $userOBJ->birthdate : ''; ?>" />
                                    </div>
                                </div>

                                <!-- PHONE - EMAIL -->
                                <div class="form-row form-space">
                                    <div class="md-form col-md-6">
                                        <label for="inputPhone">Téléphone<span class="red-text"> <?= isset($arrayError['phoneErr']) ? $arrayError['phoneErr'] : ''; ?></span></label>
                                        <input class="form-control" id="inputPhone" type="text"  maxlength = "14"  name="inputPhone" value="<?= count($arrayError) != 0 ? $userOBJ->phone : ''; ?>" />
                                    </div>

                                    <div class="md-form col-md-6">
                                        <label for="inputEmail">Email<span class="red-text"> <?= isset($arrayError['emailErr']) ? $arrayError['emailErr'] : ''; ?></span></label>
                                        <input class="form-control" id="inputEmail" type="email" name="inputEmail" value="<?= count($arrayError) != 0 ? $userOBJ->email : ''; ?>" />
                                    </div>
                                </div>

                                <!-- ADDRESS - CP - CITY -->
                                <div class="form-row form-space">
                                    <div class="md-form col-md-4">
                                        <label for="inputAddress">Adresse<span class="red-text"> <?= isset($arrayError['addressErr']) ? $arrayError['addressErr'] : ''; ?></span></label>
                                        <input class="form-control" id="inputAddress" type="text" name="inputAddress" value="<?= count($arrayError) != 0 ? $userOBJ->address : ''; ?>" />
                                    </div>
                                    <div class="md-form col-md-4">
                                        <label for="inputCp">Code Postal<span class="red-text"> <?= isset($arrayError['cpErr']) ? $arrayError['cpErr'] : ''; ?></span></label>
                                        <input class="form-control" id="inputCP" type="text" name="inputCp" value="<?= count($arrayError) != 0 ? $userOBJ->cp : ''; ?>" />
                                    </div>
                                    <div class="md-form col-md-4">
                                        <label for="inputCity">Ville<span class="red-text"> <?= isset($arrayError['cityErr']) ? $arrayError['cityErr'] : ''; ?></span></label>
                                        <input class="form-control" id="inputCity" type="text" name="inputCity" value="<?= count($arrayError) != 0 ? $userOBJ->city : ''; ?>" />
                                    </div>
                                </div>

                                <!-- PASSWORD -->
                                <div class="form-row form-space">
                                    <div class="md-form col-md-6">
                                        <label for="inputPassword">Mot de passe<span class="red-text"> <?= isset($arrayError['passwordErr']) ? $arrayError['passwordErr'] : ''; ?></span></label>
                                        <input pattern=".{8,}" required title="8 caractères minimum" class="form-control" id="inputPassword" type="text" name="inputPassword" value="<?= count($arrayError) != 0 ? $userOBJ->password : ''; ?>" />
                                    </div>
                                    <div class="md-form col-md-6">
                                        <label for="inputConfpassword">Confirmation du mot de passe<span class="red-text"> <?= isset($arrayError['confPasswordErr']) ? $arrayError['confPasswordErr'] : ''; ?></span></label>
                                        <input class="form-control" required title="Doit correspondre au mot de passe" id="inputConfpassword" type="text" name="inputConfpassword" value="" />
                                    </div>
                                </div>

                                <!-- BRAND - MODEL -->
                                <h3 class="mb-0 mt-3 grey-text form-space">Ma Moto</h3>
                                <div class="form-row">
                                    <div class="md-form col-md-6">
                                        <label for="inputBrand">Marque<span class="red-text"> <?= isset($arrayError['brandErr']) ? $arrayError['brandErr'] : ''; ?></span></label>
                                        <input class="form-control" id="inputBrand" type="text" name="inputBrand" value="<?= count($arrayError) != 0 ? $motoOBJ->brand : ''; ?>" />
                                    </div>
                                    <div class="md-form col-md-6">
                                        <label for="inputModel">Modèle<span class="red-text"> <?= isset($arrayError['modelErr']) ? $arrayError['modelErr'] : ''; ?></span></label>
                                        <input class="form-control" id="inputModel" type="text" name="inputModel" value="<?= count($arrayError) != 0 ? $motoOBJ->model : ''; ?>" />
                                    </div>
                                </div>
                            </div>

                            <!-- Validation -->
                            <div class="form-row elegant-color-dark">
                                <div class="md-form col-md-12 pad-button text-center">
                                    <div id="requiredField">
                                        <button type="submit" name="submit" class="btn grey validate">Valider</button>
                                        <a href="index.php" class="btn btn-danger">Annuler</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->
<?php include('footer.php'); ?>
<!-- BOOTSTRAP -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>                                                                                                            
</body>
</html>
