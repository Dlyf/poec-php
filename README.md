# poec-php
---static---    tout ce que le client va recevoir les fichiers statiques : css img js
---index.php--- point d'entrée : notre moteur de recherche
---include--- une inclinaison dynamique des fichiers, on inclut le header et le footer dans index.php
---action--- : nom du script qui va transmettre le formulaire
*** pour les recherches d'erreurs ***
$test = true;
echo gettype($test);
c'est un objet qui provient de la classe PDO et la première valeur est 1
