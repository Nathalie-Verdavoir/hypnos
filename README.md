# Hypnos

![Le logo](https://github.com/Nathalie-Verdavoir/hypnos/blob/documents/public/images/logoGithub.png)

## 1-Un projet symfony

### Déployez en local

Clonez le projet sur votre ficher htdocs de xampp et créer votre base de données grâce au ficher sql fourni.

Si vous démarrez de zéro, vous devrez commencer par ajouter un compte admin dans la table user avec un mot de passe pré-encodé avec **Bcrypt** : <https://www.bcrypt.fr/>
La commande sql est la suivante :

```sql
INSERT INTO `user` VALUES (1,NULL,'UNE ADRESSE MAIL','[\"ROLE_ADMIN\"]','MOT DE PASSE ENCRYPTE','LE NOM','LE PRENOM');
```

La valeur la plus importante étant le role, pensez à bien échaper les doubles quotes pour éviter les problèmes de correspondance dans symfony.

Ajoutez les fichiers de configuration des variables d'environnement (.env, .env.local).

Ce projet nécessite le paramétrage de APP_ENV, APP_SECRET, DATABASE_URL ET MAILER_DSN

Pour installer les dépendances de symfony pour ce projet, lancez la commande :

```bash
composer install
```

Pour servir votre application, lancez la commande :

```bash
symfony server:start
```

Pensez également à activer MySQL sur xampp pour que votre base de données soit accessible.

Ouvrez votre navigateur sur **<http://localhost:8000/>**

Pour plus d'informations, vous pouvez lire la documentations symfony :
<https://symfony.com/doc/current/setup.html>

### Déployez en ligne (sur Heroku)

Pour le déploiement en ligne, il vous suffira de créer un compte Heroku (gratuit). Une fois le projet cloner sur un compte github, la connection peut être établie de diverses façons:

1. Par les CLI heroku depuis la console VSCODE par exemple.
1. En automatisant le déploiement sur la branche principale de votre github. Pour cela il faudra choisir l'option adéquate depuis le dashboard de Heroku dans l'onglet deploy. *
1. De façon manuelle, en sélection la branche à déployer en bas de la page deploy. *

(*Attention cette fonctionnalité n'est pas disponible à l'heure où sont rédigées ces lignes (19/04/2022), suite à un piratage de github, heroku a fermé les connections directes entre gihub et leur app)

Attention, les variables d'environnement (APP_ENV, APP_SECRET, DATABASE_URL ET MAILER_DSN) seront à paramétrer dans l'onglet settings (cliquez sur Reveal Config Vars) et n'oubliez pas d'ajouter le build pack **heroku/php**.
Dans l'onglet Resources vous ajouterez l'Add-on de base de données. J'ai choisis ClearDb, gratuit mais nécessitant tout de même l'entrée d'une carte bleue. La valeur de DATABASE_URL devra être reprise en fonction de cette base (copiez-collez l'intégralité de la variable dans la bonne section). Pour créer le schéma et injecter les données dans votre base en ligne, l'utilisation de workbench d'oracle, ou d'un autre utilitaire de gestion de base de données sera nécessaire pour l'exécution du script sql fourni ci-dessous.

## 2-Documents complémentaires joints au projet

+ [1-hypnos-bdd.sql](https://github.com/Nathalie-Verdavoir/hypnos/blob/documents/documents-complementaires/1-hypnos-bdd.sql)

+ [2-wireframes.pdf](https://github.com/Nathalie-Verdavoir/hypnos/blob/documents/documents-complementaires/2-wireframes.pdf)

+ [3-CHARTE.png](https://github.com/Nathalie-Verdavoir/hypnos/blob/documents/documents-complementaires/3-CHARTE.png)

+ [4-Diagramme de cas d'utlisation.PNG](https://github.com/Nathalie-Verdavoir/hypnos/blob/documents/documents-complementaires/4-Diagramme%20de%20cas%20d'utlisation.PNG)

+ [5-DS1 RESERVER UNE CHAMBRE.png](https://github.com/Nathalie-Verdavoir/hypnos/blob/documents/documents-complementaires/5-DS1%20RESERVER%20UNE%20CHAMBRE.png)

+ [6-DS2 VOIR LES RESERVATIONS.png](https://github.com/Nathalie-Verdavoir/hypnos/blob/documents/documents-complementaires/6-DS2%20VOIR%20LES%20RESERVATIONS.png)

+ [7-hypnos_schema_bdd.png](https://github.com/Nathalie-Verdavoir/hypnos/blob/documents/documents-complementaires/7-hypnos_schema_bdd.png)
  
+ [8-DOCUMENTATION-TECHNIQUE.pdf](https://github.com/Nathalie-Verdavoir/hypnos/blob/documents/documents-complementaires/8-DOCUMENTATION-TECHNIQUE.pdf)

+ [9-Manuel-d-utilisation.pdf](https://github.com/Nathalie-Verdavoir/hypnos/blob/documents/documents-complementaires/9-Manuel-d-utilisation.pdf)

+ [10-Manuel-d-utilisation.html (avec animations)](https://github.com/Nathalie-Verdavoir/hypnos/blob/documents/documents-complementaires/10-Manuel-d-utilisation.html)
  