# Hypnos

## 1-Un projet symfony

### Déployez en local

Clonez le projet sur votre ficher htdocs de xampp et créer votre base de données grâce au ficher sql fourni.

Si vous démarrez de zéro, vous devrez commencer par ajouter un compte admin dans la table user avec un mot de passe pré encodé avec **Bcrypt** : <https://www.bcrypt.fr/>
La commande sql est la suivante :
INSERT INTO `user` VALUES (1,NULL,'UNE ADRESSE MAIL','[\"ROLE_ADMIN\"]','MOT DE PASSE ENCRYPTE','LE NOM','LE PRENOM');
La valeur la plus importante tant le role, pensez à bien échapé les doubles quotes pour évité les problèmes de correspondance dans symfony.

Ajoutez les fichier de configuration des variables d'environnement (.env, .env.local).

Ce projet nécessite le paramétrage de APP_ENV, APP_SECRET, DATABASE_URL ET MAILER_DSN

Lancez la commande : ``composer install`` pour installer les dépendences de symfony pour ce projet.

Pour servir votre application, lancez la commande : ``symfony server:start``
Pensez également à activer MySQL sur xampp pour que votre base de données soit accessible.

Ouvrez votre navigateur sur **<http://localhost:8000/>**

Pour plus d'informations, vous pouvez lire la documentations symfony :
<https://symfony.com/doc/current/setup.html>

## 2-Documents complémentaires joints au projet présents dans le dossier

+ [1-hypnos-bdd.sql](https://github.com/Nathalie-Verdavoir/hypnos/blob/documents/documents-complementaires/1-hypnos-bdd.sql)

+ [2-wireframes.pdf](https://github.com/Nathalie-Verdavoir/hypnos/blob/documents/documents-complementaires/2-wireframes.pdf)

+ [3-CHARTE.png](https://github.com/Nathalie-Verdavoir/hypnos/blob/documents/documents-complementaires/3-CHARTE.png)

+ [4-Diagramme de cas d'utlisation.PNG](https://github.com/Nathalie-Verdavoir/hypnos/blob/documents/documents-complementaires/4-Diagramme%20de%20cas%20d'utlisation.PNG)

+ [5-DS1 RESERVER UNE CHAMBRE.png](https://github.com/Nathalie-Verdavoir/hypnos/blob/documents/documents-complementaires/5-DS1%20RESERVER%20UNE%20CHAMBRE.png)

+ [6-DS2 VOIR LES RESERVATIONS.png](https://github.com/Nathalie-Verdavoir/hypnos/blob/documents/documents-complementaires/6-DS2%20VOIR%20LES%20RESERVATIONS.png)

+ [7-hypnos_schema_bdd.png](https://github.com/Nathalie-Verdavoir/hypnos/blob/documents/documents-complementaires/7-hypnos_schema_bdd.png)
  
+ [8-DOCUMENTATION-TECHNIQUE.pdf](https://github.com/Nathalie-Verdavoir/hypnos/blob/documents/documents-complementaires/8-DOCUMENTATION-TECHNIQUE.pdf)
