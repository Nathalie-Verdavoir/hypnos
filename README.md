# Hypnos

## 1-Un projet symfony

### Déployez en local

Clonez le projet sur votre ficher htdocs de xampp et créer votre base de données grâce qu ficher sql fourni.

Vous devrez commencer par ajouter un compte admin dans la table user avec un mot de passe pré encodé avec **Bcrypt** : <https://www.bcrypt.fr/> J'ai d'ailleurs ajouté le script spécifique dans les documents joints.

Ajoutez les fichier de configuration des variables d'environnement (.env, .env.local).

Ce projet nécessite le paramétrage de APP_ENV, APP_SECRET, DATABASE_URL ET MAILER_DSN

Lancez la commande : ``composer install`` pour installer les dépendences de symfony pour ce projet.

Pour servir votre application, lancez la commande : ``symfony server:start``
Pensez également à activer MySQL sur xampp pour que votre base de données soit accessible.

Ouvrez votre navigateur sur **<http://localhost:8000/>**

Pour plus d'informations, vous pouvez lire la documentations symfony :
<https://symfony.com/doc/current/setup.html>

## 2-Documents complémentaires joints au projet présents dans le dossier

+ 1-hypnos-bdd.sql

+ 2-wireframes.pdf

+ 3-CHARTE.png

+ 4-Diagramme de cas d'utlisation.PNG

+ 5-DS1 RESERVER UNE CHAMBRE.png

+ 6-DS2 VOIR LES RESERVATIONS.png

+ 7-hypnos_schema_bdd.png
  
## 3-Test de l'envoi de mail

Malheureusement Mailgun utilisé ici pour l'envoi de mail aux recruteurs, n'est configurable en version sandbox (gratuite) que pour des mails vérifiés directement dans le compte utilisatuer mailgun. C'est donc ma boite mail qui reçoit tous les mails pour cette version de l'application

J'ai tout de même àjouté la ligne configurant l'envoi sur la boite du recruteur mais je l'ai commentée.

ligne 24  du MailerController.php:
``->to($annonce->getRecruteur()->getUserid()->getEmail())``
