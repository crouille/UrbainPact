<?php

class Signalement
{
    // J'ai mit l'équipe assignée en commentaire parce qu'on s'en fout pour l'instant
    // J'ai mit aussi le créateur en commentaire parce que y'aura des conflits si je fais le modèle d'Utilisateur maintenant...vu que les autres font la connexion

    private ?int $id;
    private ?string $titre;
    private ?string $description;
    private ?DateTime $dateHeure;
    private ?int $upvote;
    private ?int $downvote;
    private ?Categorie $categorie;
    private ?array $photos;
    // private ?Utilisateur $createur;
    // private ?Equipe $equipeAssignee;

    public function __construct(?int $id = null, ?string $t = null, ?string $de = null, ?DateTime $dh = null, ?int $u = null, ?int $dv = null, ?Categorie $ca = null, ?array $p = null, /*?Utilisateur $cr=null, ?Equipe $e=null*/)
    {
        $this->setId($id);
        $this->setTitre($t);
        $this->setDescription($de);
        $this->setDateHeure($dh);
        $this->setUpvote($u);
        $this->setDownvote($dv);
        $this->setCategorie($ca);
        $this->setPhotos($p);
        // $this->setCreateur($cr);
        // $this->setEquipeAssignee($e);        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): void
    {
        $this->titre = $titre;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getDateHeure(): ?DateTime
    {
        return $this->dateHeure;
    }

    public function setDateHeure(?DateTime $dateHeure): void
    {
        $this->dateHeure = $dateHeure;
    }

    public function getUpvote(): ?int
    {
        return $this->upvote;
    }

    public function setUpvote(?int $upvote): void
    {
        $this->upvote = $upvote;
    }

    public function getDownvote(): ?int
    {
        return $this->downvote;
    }

    public function setDownvote(?int $downvote): void
    {
        $this->downvote = $downvote;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): void
    {
        $this->categorie = $categorie;
    }

    public function getPhotos(): ?array
    {
        return $this->photos;
    }

    public function setPhotos(?array $photos): void
    {
        $this->photos = $photos;
    }

    /*public function getCreateur() : ?Utilisateur
    {
        return $this->createur;
    }

    public function setCreateur(?Utilisateur $createur) : void
    {
        $this->createur = $createur;        
    }

    public function getEquipeAssignee() : ?Equipe
    {
        return $this->equipeAssignee;
    }

    public function setEquipeAssignee(?Equipe $equipeAssignee) : void
    {
        $this->equipeAssignee = $equipeAssignee;        
    }*/
}
