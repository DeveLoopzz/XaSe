<?php

class CreateModel {

    private $jsonFile;

    public function __construct($jsonFilePath) {
        $this->jsonFile = $jsonFilePath;
    }

    // Mètode per afegir una nova entrada al fitxer JSON
    public function addEntry($data) {
        // Llegeix les dades existents del fitxer JSON
        $entries = $this->getAllEntries();

        // Afegeix la nova entrada al final de la llista
        $entries[] = [
            'title' => $data['title'],
            'content' => $data['content'],
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Escriu les dades actualitzades al fitxer JSON
        return $this->saveEntries($entries);
    }

    // Mètode per obtenir totes les entrades del fitxer JSON
    public function getAllEntries() {
        // Comprova si el fitxer existeix, si no, retorna una llista buida
        if (!file_exists($this->jsonFile)) {
            return [];
        }

        // Llegeix i decodifica el contingut del fitxer JSON
        $jsonData = file_get_contents($this->jsonFile);
        return json_decode($jsonData, true) ?: [];
    }

    // Mètode per guardar les entrades actualitzades al fitxer JSON
    private function saveEntries($entries) {
        // Codifica les dades a format JSON
        $jsonData = json_encode($entries, JSON_PRETTY_PRINT);

        // Escriu les dades al fitxer
        return file_put_contents($this->jsonFile, $jsonData) !== false;
    }

    // Mètode per validar les dades abans d'afegir-les al fitxer JSON
    public function validateData($data) {
        if (empty($data['title']) || empty($data['content'])) {
            return false;
        }
        return true;
    }
}

