<?php

class ProblemeDAO
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
        $prefixe = Config::get('database')['prefixe'];
        $sql = "SELECT * FROM " . $prefixe . "probleme ORDER BY dateHeure DESC, upvote DESC, id";
        $pdoStatement = $this->getPdo()->prepare($sql);
        $pdoStatement->execute();
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $pdoStatement->fetchAll();
        $problemes = $this->hydrateAll($tab);
        return $problemes;
    }

    public function findAllWithDetail(): ?array
    {
        $prefixe = Config::get('database')['prefixe'];
        $sql = "SELECT PR.id, PR.titre, PR.description, PR.dateHeure, PR.upvote, PR.downvote, PR.etat,
        C.id as categorie_id, C.libelle as categorie_libelle,
        P.id as photo_id, P.url as photo_url
        FROM " . $prefixe . "probleme PR
        INNER JOIN " . $prefixe . "probleme_categorie PC ON PR.id = PC.idprobleme
        INNER JOIN " . $prefixe . "categorie C ON PC.idCategorie = C.id
        LEFT JOIN " . $prefixe . "photo P ON S.id = P.idprobleme
        ORDER BY S.dateHeure DESC, S.upvote DESC, S.id";

        $pdoStatement = $this->getPdo()->prepare($sql);
        $pdoStatement->execute();
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $pdoStatement->fetchAll();
        $problemes = $this->hydrateAll($tab);
        return $problemes;
    }

    public function hydrate(?array $tab): ?Probleme
    {
        $probleme = new Probleme(
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

        $probleme->setCategories(array_values($categories));
        $probleme->setPhotos(array_values($photos));

        /* if(isset($tab[0]['createur_id'])){
            // j'utilise juste les attributs qui seront utiles
            $createur = new Utilisateur($tab[0]['createur_id'], $tab[0]['createur_role'], $tab[0]['createur_nom'], $tab[0]['createur_prenom'], $tab[0]['createur_mail']);
            $probleme->setCreateur($createur);
        } */
        return $probleme;
    }

    public function hydrateAll(?array $tabs): ?array
    {
        $probleme = [];
        $problemes = [];
        foreach ($tabs as $key => $tab) {
            $probleme[] = $tab;
            if (!isset($tabs[$key + 1]) || $tab['id'] != $tabs[$key + 1]['id']) {
                $problemes[] = $this->hydrate($probleme);
                $probleme = [];
            }
        }
        return $problemes;
    }
}
