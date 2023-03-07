<?php

class DBManager {

    protected function connection () {
        try {
            $bdd = new PDO('mysql:host=localhost:3306;dbname=tabdd;charset=utf8', 'nom', 'pass');
        }catch(Exception $e) {
            throw new Exception ('Erreur : '.$e->getMessage());
        }
        return $bdd;
    }

    protected function getAll ($table) {  
        $bdd= $this->connection();
        $requete = $bdd->query('SELECT * FROM '.$table);
        return $requete;
        
    }
    
}