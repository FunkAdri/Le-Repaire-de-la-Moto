<head>
    <meta charset="utf-8" />
    <title>Le Repaire de la Moto - Inscription</title>
    <!-- BOOTSTRAP -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- CSS -->
    <link rel="stylesheet" href="assets/style.css" />
</head>
<!-- NAVBAR -->
<?php include('navbar.php'); ?>

<!-- CONTENT PAGE -->
<div class="content-wrap space">
    <div class="container">
        <div class="row justify-content-center">
            <?php if ($addSuccess) { ?>
                <?php include('success.php'); ?>
            <?php } else {
                ?>
                <div class="col-sm-10 offset-sm-1 text-center">
                    <form class="grey lighten-1" name="form" id="profileForm" method="post" enctype="multipart/form-data">
                        <div class="card">
                            <!-- Card header -->
                            <div class="card-header elegant-color-dark" role="tab" id="heading1">
                                <h2 class="mb-0 mt-3 grey-text">Inscription</h2>
                            </div>
                            <div class="card-body pt-0 grey lighten-1">
                                <div class="form-row">
                                    <div class="md-form col-md-6">
                                        <label for="inputLastname">Nom<span class="red-text">* <?= isset($arrayError['lastnameErr']) ? $arrayError['lastnameErr'] : ''; ?></span></label>
                                        <input class="form-control" id="inputLastname" type="text" name="inputLastname" value="<?= count($arrayError) != 0 ? $patientsOBJ->lastname : ''; ?>" />
                                    </div>
                                    <div class="md-form col-md-6">
                                        <label for="inputFirstname">Prénom<span class="red-text">* <?= isset($arrayError['firstnameErr']) ? $arrayError['firstnameErr'] : ''; ?></span></label>
                                        <input  class="form-control" id="inputFirstname" type="text" name="inputFirstname" value="<?= count($arrayError) != 0 ? $patientsOBJ->firstname : ''; ?>" />
                                    </div>
                                </div>
                                <div class="form-row ">
                                    <div class="md-form col-md-6">
                                        <label for="inputEmail">Email<span class="red-text">* <?= isset($arrayError['emailErr']) ? $arrayError['emailErr'] : ''; ?></span></label>
                                        <input class="form-control" id="inputEmail" type="email" name="inputEmail" value="<?= count($arrayError) != 0 ? $patientsOBJ->mail : ''; ?>" />
                                    </div>
                                    <div class="md-form col-md-6">
                                        <label class="active" for="inputBirthdate">Date de naissance<span class="red-text">* <?= isset($arrayError['birthdateErr']) ? $arrayError['birthdateErr'] : ''; ?></span></label>
                                        <input class="form-control" id="inputBirthdate" type="date"  name="inputBirthdate" value="<?= count($arrayError) != 0 ? $patientsOBJ->birthdate : ''; ?>" />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="md-form col-md-12">
                                        <label for="inputPhone">Téléphone<span class="red-text">* <?= isset($arrayError['phoneErr']) ? $arrayError['phoneErr'] : ''; ?></span></label>
                                        <input class="form-control" id="inputPhone" type="text"  maxlength = "14"  name="inputPhone" value="<?= count($arrayError) != 0 ? $patientsOBJ->phone : ''; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-row elegant-color-dark">
                                <div class="md-form col-md-12">
                                    <div id="requiredField">
                                        <button type="submit" name="submit" class="btn grey validate">Envoyer</button>
                                        <a href="index.php" class="btn btn-danger">Annuler</a>
                                        <span class="red-text">* champs requis</span>
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
<?php if ($addFailure) { ?>
    <?php include('failure.php'); ?>
<?php } ?>

<!-- FOOTER -->
<?php include('footer.php'); ?>
<!-- JQUERY -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- BOOTSTRAP -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.15/js/mdb.min.js"></script>                                                                                                              
</body>
</html>