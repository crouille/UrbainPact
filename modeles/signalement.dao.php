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
        $sql = "SELECT * FROM " . PREFIXE . "signalement ORDER BY dateHeure DESC, upvote DESC, id";
        $pdoStatement = $this->getPdo()->prepare($sql);
        $pdoStatement->execute();
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $pdoStatement->fetchAll();
        $signalements = $this->hydrateAll($tab);
        return $signalements;
    }

    public function findAllWithDetail(): ?array
    {
        $sql = "SELECT S.id, S.titre, S.description, S.dateHeure, S.upvote, S.downvote, S.etat,
        C.id as categorie_id, C.libelle as categorie_libelle,
        P.id as photo_id, P.url as photo_url
        FROM " . PREFIXE . "signalement S
        INNER JOIN " . PREFIXE . "signalement_categorie SC ON S.id = SC.idSignalement
        INNER JOIN " . PREFIXE . "categorie C ON SC.idCategorie = C.id
        LEFT JOIN " . PREFIXE . "photo P ON S.id = P.idSignalement
        ORDER BY S.dateHeure DESC, S.upvote DESC, S.id";

        $pdoStatement = $this->getPdo()->prepare($sql);
        $pdoStatement->execute();
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $pdoStatement->fetchAll();
        $signalements = $this->hydrateAll($tab);
        return $signalements;
    }

    public function hydrate(?array $tab): ?Signalement
    {
        $signalement = new Signalement(
                $tab[0]['id'], $tab[0]['titre'], $tab[0]['description'],
                new DateTime($tab[0]['dateHeure']),
                $tab[0]['upvote'], $tab[0]['downvote'], $tab[0]['etat'],
        );

        $categories = [];
        $photos = [];

        foreach ($tab as $tabAssoc) {
            if (isset($tabAssoc['categorie_id'])) {
                $categories[$tabAssoc['categorie_id']] = new Categorie($tabAssoc['categorie_id'], $tabAssoc['categorie_libelle']);
            }
            if (isset($tabAssoc['photo_id'])) {
                $photos[$tabAssoc['photo_id']] = new Photo($tabAssoc['photo_id'], $tabAssoc['photo_url']);
            }
        }

        $signalement->setCategories(array_values($categories));
        $signalement->setPhotos(array_values($photos));

        /* if(isset($tab[0]['createur_id'])){
            // j'utilise juste les attributs qui seront utiles
            $createur = new Utilisateur($tab[0]['createur_id'], $tab[0]['createur_role'], $tab[0]['createur_nom'], $tab[0]['createur_prenom'], $tab[0]['createur_mail']);
            $signalement->setCreateur($createur);
        } */
        return $signalement;
    }

    public function hydrateAll(?array $tabs): ?array
    {
        $signalement = [];
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
