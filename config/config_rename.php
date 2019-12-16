<?php

/*
 * Constantes globales utilisées pour l'architecture MVC du projet.
 *
 * Les constantes commençant par DIR_ servent aux chemins absolus sur le disque dur.
 * Les constantes commençant par URL_ servent aux URLs absolues depuis localhost.
 */
define('DIR_ROOT', dirname(__DIR__));           // Chemin vers le dossier racine de l'application
const DIR_DATA  = DIR_ROOT . '/data';             // Chemin vers les données de l'application
const DIR_VIEWS = DIR_ROOT . '/templates';        // Chemin vers les vues de l'application
const DIR_WWW   = DIR_ROOT . '/public';           // Chemin vers les fichiers statiques de l'application

const URL_ROOT = 'http://localhost:8000';         // URL vers l'application
const URL_WWW  = URL_ROOT . '/';                  // URL vers les fichiers statiques de l'application


// Est-ce que la réécriture d'URL est activée ?
const CONFIG_URL_REWRITE = true;

const MONGODB_SERVER = '';
const MONGODB_DBNAME = '';

const REDIS_ENDPOINT = '';
const REDIS_PASSWORD = '';

$config =
[
    // Namespace racine de l'application.
    'app.namespace' => 'App',

    /*
     * Table des routes de l'application.
     *
     * Pour chaque nom de route listé il y a un contrôleur et éventuellement une vue associés.
     * La route '_default' est utilisée quand aucune route n'est spécifiée dans l'URL.
     */
    'mvc.routes' => include __DIR__ . '/routes.php',
];
