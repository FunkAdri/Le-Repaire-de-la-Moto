<?php

// FINI D'ÊTRE REFAIT POUR LE SITE

class user extends database {
    // Attributs utilisés dans les requêtes de la table user
    public $id;
    public $lastname;
    public $firstname;
    public $birthdate;
    public $email;
    public $phone;
    public $address;
    public $cp;
    public $city;
    public $search;
    public $rowStart = 0;
    public $rowPerPage = 5;
    
    // Ce qui va être exécuté en premier lors de l'instanciation de la classe, c'est une méthode magique
    // fonctionnant automatiquement
    public function __construct() {
        parent::__construct();
    }
    
    // Controle des doublons 
    /**
     * Vérifie si le mail du patient existe déjà, grâce aux attributs instanciés plus haut
     * afin d'éviter un doublon
     * @return 1 ou 0 s'il y a ou pas des doublons possibles
     */
    public function checkFree() {
        $query = 'SELECT * FROM `USER` WHERE email = :email';
        $sql = $this->database->prepare($query);
        $sql->bindValue(':email', $this->email, PDO::PARAM_STR);
        $sql->execute();
        return $sql->rowCount();
    }
    
    /**
     * Méthode permettant d'ajouter un utilisateur à la base de donnée du site, grâce aux attributs 
     * instanciés plus haut dans le model Utilisateur
     * @return exécute la requête pour ajouter un patient
     */
    public function addUser() {
        // On prépare la requête -> "Insert dans la table USER les champs égaux aux ID dans les colonnes correspondantes"
        $sql = $this->database->prepare('INSERT INTO `USER` (lastname, firstname, birthdate, email, phone, address, cp, city) VALUES (:lastname, :firstname, :birthdate, :email, :phone, :address, :cp, :city)');
        // On bind les valueurs
        $sql->bindValue(':lastname',$this->lastname,PDO::PARAM_STR);
        $sql->bindValue(':firstname',$this->firstname,PDO::PARAM_STR);
        $sql->bindValue(':birthdate',$this->birthdate,PDO::PARAM_STR);
        $sql->bindValue(':email',$this->email,PDO::PARAM_STR);
        $sql->bindValue(':phone',$this->phone,PDO::PARAM_STR);
        $sql->bindValue(':address',$this->address,PDO::PARAM_STR);
        $sql->bindValue(':cp',$this->cp,PDO::PARAM_STR);
        $sql->bindValue(':city',$this->city,PDO::PARAM_STR);
        // On exécute la fonction
        return $sql->execute();
    }
    
    /**
     * Méthode permettant d'afficher les données d'un utilisateur,
     * grâce aux attributs instanciés plus haut
     * @return Affichage des infos de l'utilisateur
     */
     public function displayUser() {
        // On prépare la requête -> "Prends l'e patient'utilisateur égale à l'id"
        $sql = $this->database->prepare('SELECT * FROM `USER` WHERE id = :id');
        // On bind la valeur ID au marqueur nominatif ID
        $sql->bindValue(':id', $this->id, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_OBJ);
    }
    
    // PAS ENCORE REFAIT POUR LE SITE
    
    
    // Exercice2
    /**
     * Méthode qui renvoie la liste de tous les patients ainsi que de leurs informations
     * @return Tableau des informations des patients
     */
     public function displayPatients() {
        $sql = $this->database->query('SELECT * FROM patients ORDER BY lastname');
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
    
    // Exercice4
    /**
     * Méthode qui met à jour les informations appartenanant à un patient, grâce aux attributs instanciés plus haut
     * @return Tableau des informations du patient
     */
     public function updatePatient() {
        // On preépare la requête -> "Met à jour le patient par rapport aux valeurs bind"
        $sql = $this->database->prepare('UPDATE patients SET lastname=:lastname, firstname=:firstname, birthdate=:birthdate, phone=:phone, mail=:mail WHERE id = :id');
        // On bind les valeurs
        $sql->bindValue(':lastname',$this->lastname,PDO::PARAM_STR);
        $sql->bindValue(':firstname',$this->firstname,PDO::PARAM_STR);
        $sql->bindValue(':birthdate',$this->birthdate,PDO::PARAM_STR);
        $sql->bindValue(':phone',$this->phone,PDO::PARAM_STR);
        $sql->bindValue(':mail',$this->mail,PDO::PARAM_STR);
        $sql->bindValue(':id',$this->id,PDO::PARAM_INT);
        
        return $sql->execute();
    }
    
    //Exercice11
    /**
     * Méthode permettant de supprimer un patient, grâce aux attributs instanciés plus haut
     * @return Exécute la requête pour supprimer un patient
     */
    public function deletePatient() {
        // On prépare la requête -> "Supprime dans la table patient, le patient = à cette ID
        $sql = $this->database->prepare('DELETE FROM patients WHERE id = :idPatient');
        // On bind l'ID du patient à l'objet ID en lui signifiant qu'il s'agit d'un string
        $sql->bindValue(':idPatient', $this->id, PDO::PARAM_STR);
        return $sql->execute();
    }
    
    //Exercice12
    /**
     * Méthode permettant de faire une recherche, grâce aux attributs instanciés plus haut
     * @return Exécute la requête pour effectuer une recherche
     */
    public function searchPatient() {
        // Préparation de la requête de recherche -> "Selectionne là ou la recherche ressemble au nom ou prénom
        $sql = $this->database->prepare('SELECT * FROM patients WHERE lastname LIKE :search OR firstname LIKE :search ORDER BY lastname');
        // On bind la valeur rechercher
        $sql->bindValue(':search', '%' . $this->search . '%', PDO::PARAM_STR);
        $sql->execute();
        // On récupère tous les objets
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
    
    // Exercice 13
    /**
     * Méthode permettant d'afficher un certain nombre de patients créant ainsi des pages
     * @return Tableau des informations des patients
     */
     public function paginationPatients() {
        // La requête dit -> "On select dans la table patients trier par les noms de familles et limité par par un nombre"
        $sql = $this->database->query('SELECT * FROM patients ORDER BY lastname LIMIT ' . $this->rowStart . ', ' . $this->rowPerPage);
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
    
    /**
     * Méthode permettant de compter le nombre de patients maximum par pages
     * @return Tableau des informations des patients
     */
    public function countPatients() {
        // La requête va compter le nombre de patients en partant de 0 et affichera qu'au nombre max (5)"
        $sql = $this->database->query('SELECT * FROM patients');
        return $sql->rowCount();
    }
    
    // Ce qui va être exécuté en dernier lors de l'instanciation de la classe, c'est une méthode magique
    // fonctionnant automatiquement
    public function __destruct() {
        parent::__destruct();
    }
    
}
?>

