<?php

use App\Repository\AdministratorRepository as Administrator;

include __DIR__ . '/vendor/autoload.php';
include __DIR__ . '/config/config.php';

(new Administrator())->add('vincent@lepelley.fr');