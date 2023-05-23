<?php
class Actualites {
    private $idActualites = 0;
    private $description = null;
    
    
     public function __construct(
        $idActualites = 0,
        $description = null
       
    ) {
        $this->idActualites = $idActualites;
        $this->description = $description;
       
    }


    // Getters
    public function getIdActualites() {
        return $this->idActualites;
    }

    public function getDescription() {
        return $this->description;
    }

    // Setters
    public function setIdActualites($idActualites) {
        $this->idActualites = $idActualites;
    }

    public function setDescription($description) {
        $this->description = $description;
    }
}
?>


