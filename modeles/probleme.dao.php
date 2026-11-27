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
        $sql = "SELECT P.*,
        COUNT(CASE WHEN V.type = 1 THEN 1 END) as upvotes,
        FROM " . $prefixe . "probleme P
        INNER JOIN " . $prefixe . "voter V ON P.id = V.idprobleme
        ORDER BY P.dateHeure DESC, upvotes DESC, id";
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
        $sql = "SELECT P.idprobleme, P.titre, P.description, P.dateHeure, P.type, P.etat,
        COUNT(CASE WHEN V.type = 1 THEN 1 END) as upvotes,
        COUNT(CASE WHEN V.type = 0 THEN 1 END) as downvotes, 
        C.idcategorie as categorie_id, C.libelle as categorie_libelle,
        M.idmedia as media_id, M.url as media_url, M.type as media_type
        FROM " . $prefixe . "probleme P
        INNER JOIN " . $prefixe . "voter V ON P.idprobleme = V.idprobleme
        INNER JOIN " . $prefixe . "rattacher R ON P.idprobleme = R.idprobleme
        INNER JOIN " . $prefixe . "categorie C ON R.idCategorie = C.idcategorie
        LEFT JOIN " . $prefixe . "media M ON P.idprobleme = M.idprobleme
        ORDER BY P.dateHeure DESC, upvotes DESC, P.idprobleme";

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
                $tab[0]['idprobleme'], $tab[0]['titre'], $tab[0]['description'],
                new DateTime($tab[0]['dateHeure']), $tab[0]['type'], $tab[0]['etat']
        );

        $categories = [];
        $medias = [];

        foreach ($tab as $tabAssoc) {
            if (isset($tabAssoc['categorie_id'])) {
                $categories[$tabAssoc['categorie_id']] = new Categorie($tabAssoc['categorie_id'], $tabAssoc['categorie_libelle']);
            }
            if (isset($tabAssoc['media_id'])) {
                $medias[$tabAssoc['media_id']] = new Media($tabAssoc['media_id'], $tabAssoc['media_url'], $tabAssoc['media_type']);
            }
        }

        $probleme->setCategories(array_values($categories));
        $probleme->setMedias(array_values($medias));

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
