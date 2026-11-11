<?php

class SignalementDAO
{
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

    public function findAll(): ?array
    {
        $sql = "SELECT * FROM " . PREFIXE . "signalement ORDER BY dateHeure DESC, upvote DESC";
        $pdoStatement = $this->getPdo()->prepare($sql);
        $pdoStatement->execute();
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $pdoStatement->fetchAll();
        $signalements = $this->hydrateAll($tab);
        return $signalements;
    }

    public function findAllWithDetail(): ?array
    {
        $sql = "SELECT S.id, S.titre, S.description, S.dateHeure, S.upvote, S.downvote,
        C.id as categorie_id, C.libelle as categorie_libelle,
        P.id as photo_id, P.url as photo_url
        FROM " . PREFIXE . "signalement S
        INNER JOIN " . PREFIXE . "categorie C ON S.idCategorie = C.id
        LEFT JOIN " . PREFIXE . "photo P ON S.id = P.idSignalement
        ORDER BY S.dateHeure DESC, S.upvote DESC";

        $pdoStatement = $this->getPdo()->prepare($sql);
        $pdoStatement->execute();
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $pdoStatement->fetchAll();
        $signalements = $this->hydrateAll($tab);
        return $signalements;
    }

    public function hydrate(?array $tab): ?Signalement
    {
        $signalement = new Signalement($tab[0]['id'], $tab[0]['titre'], $tab[0]['description'], $tab[0]['dateHeure'], $tab[0]['upvote'], $tab[0]['downvote']);
        if (isset($tab[0]['categorie_id'])) {
            $categorie = new Categorie($tab[0]['categorie_id'], $tab[0]['categorie_libelle']);
            $signalement->setCategorie($categorie);
        }
        if (isset($tab[0]['photo_id'])) {
            $photos = [];
            foreach ($tab as $tabAssoc) {
                $photo = new Photo($tabAssoc['photo_id'], $tabAssoc['photo_url']);
                $photos[] = $photo;
            }
            $signalement->setPhotos($photos);
        }
        /* if(isset($tab[0]['createur_id'])){
            // j'utilise juste les attributs qui seront utiles
            $createur = new Utilisateur($tab[0]['createur_id'], $tab[0]['createur_role'], $tab[0]['createur_nom'], $tab[0]['createur_prenom'], $tab[0]['createur_mail']);
            $signalement->setCreateur($createur);
        } */
        return $signalement;
    }

    public function hydrateAll(?array $tabs): ?array
    {
        $signalements = [];
        foreach ($tabs as $key => $tab) {
            $signalement[] = $tab;
            if (!isset($tabs[$key + 1]) || $tab['id'] != $tabs[$key + 1]['id']) {
                $signalements[] = $this->hydrate($signalement);
                $signalement = [];
            }
        }
        return $signalements;
    }
}
