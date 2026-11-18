<?php

class UtilisateurDao
{
    private const COLONNES = "idUtilisateur, role, prenom, nom, dateNaissance, email, mdp";

    private ?PDO $pdo;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo;
    }

    public function getPdo(): ?PDO
    {
        return $this->pdo;
    }

    public function setPdo(?PDO $pdo): void
    {
        $this->pdo = $pdo;
    }

    public function find(int $id): ?Utilisateur
    {
        $sql = "SELECT " . self::COLONNES . " FROM " . Config::get('database')['prefixe'] . "utilisateur WHERE idUtilisateur = :id";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute(['id' => $id]);
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        $ligne = $pdoStatement->fetch();
        // fetch() renvoie false (et non null) quand il n'y a pas de résultat
        return $ligne === false ? null : $this->hydrate($ligne);
    }

    public function findByEmail(string $email): ?Utilisateur
    {
        $sql = "SELECT " . self::COLONNES . " FROM " . Config::get('database')['prefixe'] . "utilisateur WHERE email = :email";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute(['email' => $email]);
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        $ligne = $pdoStatement->fetch();
        return $ligne === false ? null : $this->hydrate($ligne);
    }

    public function hydrate(array $ligne): Utilisateur
    {
        $utilisateur = new Utilisateur();
        $utilisateur->setId((int) $ligne['idUtilisateur']);
        $utilisateur->setRole($ligne['role']);
        $utilisateur->setPrenom($ligne['prenom']);
        $utilisateur->setNom($ligne['nom']);
        $utilisateur->setDateNaissance(new DateTime($ligne['dateNaissance']));
        $utilisateur->setEmail($ligne['email']);
        $utilisateur->setMotDePasse($ligne['mdp']);
        return $utilisateur;
    }
}