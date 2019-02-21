<head>
    <meta charset="utf-8" />
    <title>Le Repaire de la Moto - Contact</title>
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
<div class="container margtop-2 marg-bot2">
    <div class="row">

        <!-- CONNEXION -->
        <div class="col-sm-12 col-md-6 col-lg-6 marg-bot">
            <div class="card">
                <div class="form-row form-space margtop-1">
                    <div class="md-form col-md-8 marg-center margtop-1">
                        <label class="" for="inputLogin">Adresse E-Mail<span class="red-text"> <?= isset($arrayError['#']) ? $arrayError['#'] : ''; ?></span></label>
                        <input class="form-control" id="inputLogin" type="text" name="inputLogin" value="<?= count($arrayError) != 0 ? $userOBJ->lastname : ''; ?>" />
                    </div>
                </div>
                <div class="form-row form-space">
                    <div class="md-form col-md-8 marg-center">
                        <label for="inputPassword">Mot de passe<span class="red-text"> <?= isset($arrayError['#']) ? $arrayError['#'] : ''; ?></span></label>
                        <input class="form-control marg-bot" id="inputPassword" type="text" name="inputPassword" value="<?= count($arrayError) != 0 ? $userOBJ->lastname : ''; ?>" />
                    </div>
                </div>
                
                <!-- CONNEXION -->
                <a class="text-center marg-bot"><button type="submit" name="submit" class="btn grey validate">Connexion</button></a>
            </div>
        </div>

        <!-- INSCRIPTION -->
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <p class="text-center margtop-choice marg-bot">Pas encore de compte ?</p>
                <a class="marg-center margbot-choice" href="/views/inscription.php"><button type="button" class="btn btn-white">Je m'inscris !</button></a>
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