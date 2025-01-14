# Consignes projet userbase POO

## Étape 0 : repo GitHub

Créez un repository GitHub public avec un README pour votre projet, appelez-le `bre02_php_userbasepoo`.
Clonez le dans le dossier `sites/php` de votre IDE.

Récupérez le zip des fichiers du projet sur Discord.


## Étape 1 : importer la base de données

Dans votre PhpMyAdmin, créez une base de données `prenomnom_userbase_poo` et importez-y le fichier SQL `users.sql` que vous trouverez sur Discord.


## Étape 2 : Créer la classe User

Créez un dossier `models` et créez-y un fichier `User.php`.

Vous allez y définir une classe `User`.

Votre `User` a 5 attributs private :

- `id` qui est un int et peut être null, sa valeur par défaut est null
- `username` qui est une string
- `email` qui est une string
- `password` qui est une string
- `role` qui est une string, sa valeur par défaut est `"USER"`

Le constructeur de la classe `User` prend en argument les attributs suivants :

- username
- email
- password
- role

Il a des getters et setters pour chacun des attributs.


## Étape 3 : Créer la classe UserManager

Créez un dossier `managers` et créez-y un fichier `UserManager.php`.

Vous allez y définir une classe `UserManager`.

Votre `UserManager` a 2 attributs private :

- `users` qui est un tableau, sa valeur par défaut est un tableau vide
- `db` qui est une instance la classe PDO

Le constructeur de la classe `UserManager` ne prend pas d'argument mais il initialise son attribut db avec les informations de connexion à votre base de données.

La classe `UserManager` a un getter et un setter pour l'attribut `users`.

La classe `UserManager` a 3 méthodes public :

- `loadUsers` qui ne prend pas d'arguments et ne retourne rien
- `saveUser` qui prend un `User` en argument et ne retourne rien
- `deleteUser` qui prend un `User` en argument et ne retourne rien

Pour l'instant, ne codez pas le comportement de ces méthodes.


## Étape 4 : Afficher les User

### Étape 4.1 : la méthode loadUsers du UserManager

Vous allez maintenant coder la méthode `loadUsers` de votre `UserManager`. Celle-ci doit récupérer tous les utilisateur depuis la base de données. Pour chacun des utilisateurs vous allez instancier une instance de classe `User` que vous hydraterez avec les informations récupérées en base de données. Vous stockerez tous ces `User` dans un tableau puis vous utiliserez le setter de l'attribut `users` du `UserManager` pour remplacer le tableau existant par celui que vous venez de créer.

### Étape 4.2 : préparer les données

Dans le fichier `logic/display-users.php` vous allez instancier une instance de la classe `UserManager` puis appeler sa méthode `loadUsers` pour en stocker le résultat dans une variable.

### Étape 4.3 : afficher les données

Utilisez les données obtenues grâce aux étapes 4.1 et 4.2 pour dynamiser la table des utilisateurs dans le fichier `template/user-list.phtml`. N'oubliez pas de dynamiser le lien du bouton de suppression.


## Étape 5 : Créer un User

Reproduisez le processus de l'étape 4 mais cette fois vous allez récupérer les données du formulaire pour remplir une instance de classe `User` et la passer au `UserManager` qui la sauvegardera en base de données.

N'oubliez pas de rediriger vers `index.php` une fois que `logic/create-user.php` aura fini sa création. 


## Étape 6 : Supprimer un User

Même processus mais pour supprimer un utilisateur.


