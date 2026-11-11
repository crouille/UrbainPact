<?php

class Categorie{
    private ?int $id;
    private ?string $libelle;

    public function __construct(?int $id=null, ?string $l=null)
    {
        $this->setId($id);
        $this->setLibelle($l);
    }

    public function getId() : ?int
    {
        return $this->id;
    }

    public function setId(?int $id) : void
    {
        $this->id = $id;        
    }

    public function getLibelle() : ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle) : void
    {
        $this->libelle = $libelle;        
    }
}