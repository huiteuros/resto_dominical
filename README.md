## Ce projet

Les fonctionnalités de ce site ne sont disponnibles qu'une fois connecté. 
Il est né d'une envie de statistiques sur les restaurants qu'on faisait entre copains.
On peut donc gérer des restaurants et des copains. Laisser des avis sur les restaurants qu'on a fait et consulter qui était présent.
C'est donc un projet perso, je vois peu de raison de le cloner mais on sait jamais. C'est dispo si jamais !

## Pour utiliser
Prérequis : PHP, Composer, NPM

- Cloner le projet : ```git clone https://github.com/huiteuros/resto_dominical.git```
- Installer les dépendances : ```composer install```
- Build le public/build : ```npm run build (si besoin npm install avant)```
- Copier le ```.env.example``` et le renommer ```.env```
- Renseigner les bonnes valeures dans ce fichier.
- Faire les migrations : ```php artisan migrate``` (il est possible qu'il y ai des erreurs : à tester)

## Pour les copains 
Si vous passez par là, hésitez pas à ouvrir des issues si vous rencontrez un problème ou que vous avez une nouvelle idée :
https://github.com/huiteuros/resto_dominical/issues
Le bouton new issue en vert en haut à droite.

La documentation du site est dispo ici : https://github.com/huiteuros/resto_dominical/wiki
