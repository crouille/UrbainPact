<?php

class Probleme
{
    private ?int $idprobleme;
    private ?string $titre;
    private ?string $description;
    private ?DateTime $dateHeure;
    private ?array $categories;
    private ?bool $type;
    private ?string $etat;
    private ?array $medias;
    private ?int $upvote;
    private ?int $downvote;
    // private ?Utilisateur $createur;
    // private ?Equipe $equipeAssignee;

    public function __construct(?int $i = null, ?string $t = null, ?string $de = null, ?DateTime $dh = null, ?bool $ty = null, ?string $et = null, ?array $ca = null, ?array $m = null, ?int $u = null, ?int $dv = null /*?Utilisateur $cr=null, ?Equipe $e=null*/)
    {
        $this->setIdprobleme($i);
        $this->setTitre($t);
        $this->setDescription($de);
        $this->setDateHeure($dh);
        $this->setType($ty);
        $this->setEtat($et);
        $this->setCategories($ca);
        $this->setMedias($m);
        $this->setUpvote($u);
        $this->setDownvote($dv);
        // $this->setCreateur($cr);
        // $this->setEquipeAssignee($e);        
    }

    public function getIdprobleme(): ?int
    {
        return $this->idprobleme;
    }

    public function setIdprobleme(?int $idprobleme): void
    {
        $this->idprobleme = $idprobleme;
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

    public function getType(): ?bool
    {
        return $this->type;
    }

    public function setType(?bool $type): void
    {
        $this->type = $type;
    }

    public function getEtat(): ?string {
        return $this->etat;
    }

    public function setEtat(?string $etat): void {
        $this->etat = $etat;
    }

    public function getCategories(): ?array
    {
        return $this->categories;
    }

    public function setCategories(?array $categories): void
    {
        $this->categories = $categories;
    }

    public function getMedias(): ?array
    {
        return $this->medias;
    }

    public function setMedias(?array $medias): void
    {
        $this->medias = $medias;
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
