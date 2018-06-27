# poec-php
---static---    tout ce que le client va recevoir les fichiers statiques : css img js
---index.php--- point d'entrée : notre moteur de recherche
---include--- une inclinaison dynamique des fichiers, on inclut le header et le footer dans index.php
---action--- : nom du script qui va transmettre le formulaire
*** pour les recherches d'erreurs ***
$test = true;
echo gettype($test);
c'est un objet qui provient de la classe PDO et la première valeur est 1

RECAP :

système d'autification en placeholder
2 liens principales: connexion m'offre un formulaire
quand je valide je renvoie un login login_processverifie que le post e mail et pass soient vérifier on tente à se connecter

traitement en  4 étapes : connecter, binding
sizeof c'est tester la taille
HTTP est stateless il est sans état (=amnésique) le protocole http n'a pas de mémoire.
SESSION visant à créer dans la mémoire vive du serveur de ouvrir une session qui va etre un espace stockage temporaire

// action  : réception du traitement de donnée
du binding : requete préparé
