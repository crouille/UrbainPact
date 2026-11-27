<?php

class Categorie
{
    private ?int $idcategorie;
    private ?string $libelle;

    public function __construct(?int $id = null, ?string $l = null)
    {
        $this->setId($id);
        $this->setLibelle($l);
    }

    public function getIdcategorie(): ?int
    {
        return $this->idcategorie;
    }

    public function setId(?int $idcategorie): void
    {
        $this->idcategorie = $idcategorie;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): void
    {
        $this->libelle = $libelle;
    }
}
