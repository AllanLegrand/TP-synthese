-- Étape 1 : Création de la fonction qui supprime les projets orphelins, sans utilisateur (donc sans groupe)
CREATE OR REPLACE FUNCTION supprimer_projets_orphelins()
RETURNS TRIGGER AS $$
BEGIN
    DELETE FROM Projet
    WHERE idProjet NOT IN (SELECT DISTINCT idProjet FROM Groupe);

    RETURN NULL;
END;
$$ LANGUAGE plpgsql;

-- Étape 2 : Création du trigger sur la table Groupe
CREATE TRIGGER check_projets_orphelins
AFTER DELETE ON Groupe
FOR EACH ROW
EXECUTE FUNCTION supprimer_projets_orphelins();
