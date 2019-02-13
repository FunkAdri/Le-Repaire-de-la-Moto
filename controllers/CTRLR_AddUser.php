<?php
require_once '/models/database.php';
require_once '/models/userModel.php';

// Instanciation de l'objet Hospital contenant les méthodes utilisées
$userOBJ = new user();
$addSuccess = false;
$link = '/views/liste-patients.php';
$successPage = 'Patient ajouté';
$linkText = 'des patients';

// Gestion de l'affichage des bandeaux succès (success.php) et echec (failure.php)
$rendezvousSuccess = false;
$rendezvousFailure = false;
$failurePage = 'Le mail ' . $userOBJ->email . ' ';

// variable de récupération d'erreurs
$arrayError = [];

// Test des champs obligatoires
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // regex utilisées pour le contrôle de saisie
    $patternName = '/^[a-zA-ZÀ-Ÿ \'-]*$/';
    $patternPhone = '/^0[0-9]([ .-]?[0-9]{2}){4}$/';
    // contrôle de saisie
    
    // LASTNAME
    if (empty($_POST['inputLastname'])) {
        $arrayError['lastnameErr'] = 'Le nom est requis';
    } else {
        $userOBJ->lastname = test_input($_POST['inputLastname']);
        // vérifie si le champs contient des lettres et de la ponctuation
        if (!preg_match($patternName, $userOBJ->lastname)) {
            $arrayError['lastnameErr'] = 'Caractères incorrects ex : DOE';
        } else {
            $userOBJ->lastname = mb_strtoupper($userOBJ->lastname,'UTF-8');
            unset($arrayError['lastnameErr']);
        }
    }
    
    // FIRSTNAME
    if (empty($_POST['inputFirstname'])) {
        $arrayError['firstnameErr'] = 'Le prénom est requis';
    } else {
        $userOBJ->firstname = test_input($_POST['inputFirstname']);
        
        // vérifie si le champs contient des lettres et de la ponctuation
        if (!preg_match($patternName, $userOBJ->firstname)) {
            $arrayError['firstnameErr'] = 'Caractères incorrects ex : Adrien';
        } else {
            $userOBJ->firstname = ucfirst(mb_strtolower($userOBJ->firstname,'UTF-8'));
            unset($arrayError['firstnameErr']);
        }
    }
    
    // EMAIL
    if (empty($_POST['inputEmail'])) {
        $arrayError['emailErr'] = 'L\'email est requis';
    } else {
        $userOBJ->email = test_input($_POST['inputEmail']);
        // vérifie si le champs contient un email
        if (!filter_var($userOBJ->email, FILTER_VALIDATE_EMAIL)) {
            $arrayError['emailErr'] = 'Format d\'email invalide ex : prenom.nom@mail.com';
        } else {
            unset($arrayError['emailErr']);
        }
    }
    
    // BIRTHDATE
    if (empty($_POST['inputBirthdate'])) {
        $arrayError['birthdateErr'] = 'La date de naissance est requise';
    } else {
        $userOBJ->birthdate = test_input($_POST['inputBirthdate']);
        $dateTime1 = new DateTime($userOBJ->birthdate);
        $dateTime2 = new DateTime(date('Y-m-d'));
        // vérifie si le champs contient une date de naissance plausible
        if (!$dateTime1->diff($dateTime2)>0) {
            $arrayError['emailErr'] = 'Date incorrecte ex: 07/03/1998';
        } else {
            unset($arrayError['birthdateErr']);
        }
    }
    
    // PHONE
    if (empty($_POST['inputPhone'])) {
        $arrayError['phoneErr'] = 'Le téléphone est requis.';
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
        $arrayError['addressErr'] = 'L\'adresse est requise';
    } else {
        $userOBJ->address = test_input($_POST['inputAddress']);
        // vérifie si le champs contient des lettres et de la ponctuation
        if (!preg_match($patternName, $userOBJ->address)) {
            $arrayError['addressErr'] = 'Caractères incorrects ex : 1 Ruelle Cabot';
        } else {
            $userOBJ->address = mb_strtoupper($userOBJ->address,'UTF-8');
            unset($arrayError['addressErr']);
        }
    }
    
    // VALIDER
    if (isset($_POST['submit']) && count($arrayError) == 0) {
        $count = $userOBJ->checkFree(); // Vérification de l'existence d'un doublon avant insertion dans la base
        if ($count > 0) {
            $addFailure = true;
        } else {
            $addFailure = false;
            // exécute la méthode permettant l'ajout de patient
            $testDoubleEntry = $userOBJ->addPatient();
            if ($testDoubleEntry === false) {
                $addSuccess = false; // variable mise à false
            } else {
                $addSuccess = true; // variable mise à true pour cacher le formulaire
            }
        }
    }
}

// fonction de sécurisation de la saisie, injection de code, espaces et antislashs
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
