# Projet Clone de Netflix en PHP pur

#### <u>Présentation du projet:</u>

Le projet viens du formateur Believemy sur la plateforme [Udemy](https://www.udemy.com/user/believemy/). Il nous fourni le code HTML/CSS pour ne pas se soucier du design et on doit faire le PHP dans son ensemble. Voici les différentes fonctionnalités sur lesquelles j'ai du travailler:

- **Creation de la base de donnée sur Phpmyadmin.**
- **Création des tables**
  - ID
  - Email 
  - Mot de passe
  - Secret (Pour ne pas stocker le mdp ou mail dans les cookies/sessions)
  - Date de création
- **Inscription dans la DB avec les règles de sécurité (htmlspecialchars, prepare, hashage du mot de passe)**
- **Connexion avec les règles de sécurité + création d'un cookie si la case** '*se souvenir de moi* '**est cochée**
- **Déconnexion + Désactivation de la session ET suppression de cette dernière + Suppression du cookie**
- **Système de connexion automatique avec le cookie créer précédemment**
