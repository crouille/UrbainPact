<?php

class Utilisateur {
    private ?int $id;
    private ?string $role;
    private ?string $prenom;
    private ?string $nom;
    private ?DateTime $dateNaissance;
    private ?string $email;
    private ?string $motDePasse;

    public function __construct(?int $id = null, ?string $role = null, ?string $prenom = null, ?string $nom = null,
                                ?DateTime $dateNaissance = null, ?string $email = null, ?string $motDePasse = null) {
        $this->id = $id;
        $this->role = $role;
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->dateNaissance = $dateNaissance;
        $this->email = $email;
        $this->motDePasse = $motDePasse;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): void
    {
        $this->role = $role;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): void
    {
        $this->prenom = $prenom;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(?string $motDePasse): void
    {
        $this->motDePasse = $motDePasse;
    }

    public function getDateNaissance(): ?DateTime
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(?DateTime $dateNaissance): void
    {
        $this->dateNaissance = $dateNaissance;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): void
    {
        $this->nom = $nom;
    }


}