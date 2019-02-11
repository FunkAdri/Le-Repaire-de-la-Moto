<?php

// FINI D'ÊTRE REFAIT POUR LE SITE

class patients extends database {
    // Attributs utilisés dans les requêtes de la table patients
    public $brand;
    public $model;
    
    // Ce qui va être exécuté en premier lors de l'instanciation de la classe, c'est une méthode magique
    // fonctionnant automatiquement
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Méthode permettant d'ajouter un utilisateur à la base de donnée du site, grâce aux attributs 
     * instanciés plus haut dans le model Utilisateur
     * @return exécute la requête pour ajouter un patient
     */
    public function addMoto() {
        // On prépare la requête -> "Insert dans la table USER les champs égaux aux ID dans les colonnes correspondantes"
        $sql = $this->database->prepare('INSERT INTO `MOTOS` (lastname, firstname, birthdate, email, phone, address, cp, city) VALUES (:lastname, :firstname, :birthdate, :email, :phone, :address, :cp, :city)');
        // On bind les valueurs
        $sql->bindValue(':brand',$this->lastname,PDO::PARAM_STR);
        $sql->bindValue(':model',$this->firstname,PDO::PARAM_STR);
        // On exécute la fonction
        return $sql->execute();
    }
    
    // Ce qui va être exécuté en dernier lors de l'instanciation de la classe, c'est une méthode magique
    // fonctionnant automatiquement
    public function __destruct() {
        parent::__destruct();
    }
    
}
?>