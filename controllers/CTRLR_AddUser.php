<?php

require_once '../models/database.php';
require_once '../models/userModel.php';

// Instanciation de l'objet User contenant les méthodes utilisées
$userOBJ = new user();
$addSuccess = false;
//$link = '/views/liste-patients.php';
$successPage = 'Vous êtes bien inscrit !';
//$linkText = 'des patients';
// Gestion de l'affichage des bandeaux succès (success.php)
$rendezvousSuccess = false;
$failurePage = 'Le mail ' . $userOBJ->email . ' ';

// variable de récupération d'erreurs
$arrayError = [];

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Test des champs obligatoires
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // regex utilisées pour le contrôle de saisie
    $patternName = '/^[a-zA-ZÀ-Ÿ \'-]*$/';
    $patternPhone = '/^0[0-9]([ .-]?[0-9]{2}){4}$/';
    $patternAddress = '/^[0-9a-zA-ZÀ-Ÿ \'-]*$/';
    $patternCp = '/^[0-9]{5,5}$/';
    $patternPassword = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)$/';
    // Explication de la regex du mot de passe (et des autres regex) :
    // 'preg_match' recherche une ou plusieurs occurences d'un caractère
    // '/' on délimite la regex '^' on indique son début et '$' indique la fin de la regex
    // '?=.*' on indique les occurences 0 ou 1 ou plusieurs
    // 'a-z,A-Z,0-9' permet de tester la présence de lettres minuscules, majuscules ou de chiffres
    // '\W' test la présence de caractères spéciaux
    // On peut aussi concaténer '{8,}' qui permet de vérifier que le mot de passe comporte 
    // minimum 8 caractères mais je met un elseif pour séparer l'erreur de taille et de contenue
    // même si la concaténation ça allège le code
    // contrôle de saisie
    // LASTNAME
    if (empty($_POST['inputLastname'])) {
        $arrayError['lastnameErr'] = ' requis';
    } else {
        $userOBJ->lastname = test_input($_POST['inputLastname']);
        // vérifie si le champs contient des lettres et de la ponctuation
        if (!preg_match($patternName, $userOBJ->lastname)) {
            $arrayError['lastnameErr'] = 'Caractères incorrects ex : DOE';
        } else {
            $userOBJ->lastname = mb_strtoupper($userOBJ->lastname, 'UTF-8');
            unset($arrayError['lastnameErr']);
        }
    }

    // FIRSTNAME
    if (empty($_POST['inputFirstname'])) {
        $arrayError['firstnameErr'] = ' requis';
    } else {
        $userOBJ->firstname = test_input($_POST['inputFirstname']);

        // vérifie si le champs contient des lettres et de la ponctuation
        if (!preg_match($patternName, $userOBJ->firstname)) {
            $arrayError['firstnameErr'] = 'Caractères incorrects ex : Adrien';
        } else {
            $userOBJ->firstname = ucfirst(mb_strtolower($userOBJ->firstname, 'UTF-8'));
            unset($arrayError['firstnameErr']);
        }
    }

    // BIRTHDATE
    if (empty($_POST['inputBirthdate'])) {
        $arrayError['birthdateErr'] = ' requise';
    } else {
        $userOBJ->birthdate = test_input($_POST['inputBirthdate']);
        $dateTime1 = new DateTime($userOBJ->birthdate);
        $dateTime2 = new DateTime(date('Y-m-d'));
        // vérifie si le champs contient une date de naissance plausible
        if (!$dateTime1->diff($dateTime2) > 0) {
            $arrayError['emailErr'] = 'Date incorrecte ex: 07/03/1998';
        } else {
            unset($arrayError['birthdateErr']);
        }
    }

    // EMAIL
    if (empty($_POST['inputEmail'])) {
        $arrayError['emailErr'] = ' requis';
    } else {
        $userOBJ->email = test_input($_POST['inputEmail']);
        // vérifie si le champs contient un email
        if (!filter_var($userOBJ->email, FILTER_VALIDATE_EMAIL)) {
            $arrayError['emailErr'] = 'Format d\'email invalide ex : prenom.nom@mail.com';
        } else {
            unset($arrayError['emailErr']);
        }
    }

    // PHONE
    if (empty($_POST['inputPhone'])) {
        $arrayError['phoneErr'] = ' requis.';
    } else {
        $userOBJ->phone = test_input($_POST['inputPhone']);
        if (!preg_match($patternPhone, $userOBJ->phone)) {
            $arrayError['phoneErr'] = 'Il y a une erreur dans le numéro de téléphone';
        } else {
            unset($arrayError['inputPhone']);
        }
    }

    // ADDRESS
    if (empty($_POST['inputAddress'])) {
        $arrayError['addressErr'] = ' requise';
    } else {
        $userOBJ->address = test_input($_POST['inputAddress']);
        // vérifie si le champs contient des lettres et de la ponctuation
        if (!preg_match($patternAddress, $userOBJ->address)) {
            $arrayError['addressErr'] = 'Caractères incorrects ex : 1 Ruelle Cabot';
        } else {
            $userOBJ->address = mb_strtoupper($userOBJ->address, 'UTF-8');
            unset($arrayError['addressErr']);
        }
    }

    // CP
    if (empty($_POST['inputCp'])) {
        $arrayError['cpErr'] = ' requis';
    } else {
        $userOBJ->cp = test_input($_POST['inputCp']);
        // vérifie si le champs contient des lettres et de la ponctuation
        if (!preg_match($patternCp, $userOBJ->cp)) {
            $arrayError['cpErr'] = 'Caractères incorrects ex : 76210';
        } else {
            $userOBJ->cp = mb_strtoupper($userOBJ->cp, 'UTF-8');
            unset($arrayError['cpErr']);
        }
    }

    // CITY
    if (empty($_POST['inputCity'])) {
        $arrayError['cityErr'] = ' requise';
    } else {
        $userOBJ->city = test_input($_POST['inputCity']);
        // vérifie si le champs contient des lettres et de la ponctuation
        if (!preg_match($patternName, $userOBJ->city)) {
            $arrayError['cityErr'] = 'Caractères incorrects ex : Bolbec';
        } else {
            $userOBJ->city = mb_strtoupper($userOBJ->city, 'UTF-8');
            unset($arrayError['cityErr']);
        }
    }

    // PASSWORD
    // On vérifie que l'input n'est pas vide
    if (empty($_POST['inputPassword'])) {
        $arrayError['passwordErr'] = ' requis';
    } else {

        $userOBJ->password = test_input($_POST['inputPassword']);
        // On détermine sa longueur avec la fonction string length et si il est plus petit que 8
        // caractères, on le rejette et on affiche un message
        if (strlen($_POST['inputPassword']) < 8) {
            echo "Mot de passe trop court ! 8 Caractères minimum";
            // On check que le mot de passe fonctionne avec la regex
        } elseif (!preg_match($patternPassword, $userOBJ->password)) {
            // Si ça marche
            echo 'Mot de passe conforme';
            // Sinon, si le mot de passe n'est pas conforme
        } else {
            echo 'Mot de passe non conforme';
        }
    }

    // VERIFICATION DU MOT DE PASSE
    // On vérifie que ce que l'on récupère dans l'input de confirmation est la même chose que
    // dans l'input password
    if ($_POST['inputConfpassword'] != $_POST['inputPassword']) {
        echo 'Les 2 mots de passe sont différents';
    } else {
        echo 'Mot de passe confirmer';
    }

    // VALIDER
    if (isset($_POST['submit']) && count($arrayError) == 0) {
        $count = $userOBJ->checkFree(); // Vérification de l'existence d'un doublon avant insertion dans la base
        if ($count > 0) {
            $addFailure = true;
        } else {
            $addFailure = false;
            // exécute la méthode permettant l'ajout de patient
            $testDoubleEntry = $userOBJ->addUser();
            if ($testDoubleEntry === false) {
                $addSuccess = false; // variable mise à false
            } else {
                $addSuccess = true; // variable mise à true pour cacher le formulaire
            }
        }
    }
}

// fonction de sécurisation de la saisie, injection de code, espaces et antislashs
?>
