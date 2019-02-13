<?php

require_once '../models/database.php';
require_once '../models/motoModel.php';

// Instanciation de l'objet User contenant les méthodes utilisées
$motoOBJ = new moto();

// Test des champs obligatoires
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // regex utilisées pour le contrôle de saisie de la marque et du modèle
    $patternName = '/^[a-zA-ZÀ-Ÿ0-9 \'-]*$/';

// BRAND
    if (empty($_POST['inputBrand'])) {
        $arrayError['brandErr'] = ' requise';
    } else {
        $motoOBJ->brand = test_input($_POST['inputBrand']);
        // vérifie si le champs contient des lettres et de la ponctuation
        if (!preg_match($patternName, $motoOBJ->brand)) {
            $arrayError['brandErr'] = 'Caractères incorrects ex : Yamaha';
        } else {
            $motoOBJ->brand = mb_strtoupper($motoOBJ->brand, 'UTF-8');
            unset($arrayError['brandErr']);
        }
    }

// MODEL
    if (empty($_POST['inputModel'])) {
        $arrayError['modelErr'] = ' requis';
    } else {
        $motoOBJ->model = test_input($_POST['inputModel']);
        // vérifie si le champs contient des lettres et de la ponctuation
        if (!preg_match($patternName, $motoOBJ->model)) {
            $arrayError['modelErr'] = 'Caractères incorrects ex : XSR700 XTribute';
        } else {
            $motoOBJ->model = mb_strtoupper($motoOBJ->model, 'UTF-8');
            unset($arrayError['modelErr']);
        }
    }

    // VALIDER
if (isset($_POST['submit']) && count($arrayError) == 0) {
        } else {
            $addFailure = false;
            // exécute la méthode permettant l'ajout de patient
            $testDoubleEntry = $motoOBJ->addMoto();
            if ($testDoubleEntry === false) {
                $addSuccess = false; // variable mise à false
            } else {
                $addSuccess = true; // variable mise à true pour cacher le formulaire
            }
        }
    }

?>
 