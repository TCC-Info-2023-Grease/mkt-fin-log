<?php
require __DIR__ . '/config.php';
require __DIR__ . '/routes/router_run.php';

router_run($routes, $_ENV);
