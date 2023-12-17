<?php  
require dirname(dirname(dirname(__DIR__))) . '/config.php';
global $_ENV;

import_utils([ 'navegate', 'auth' ]);

Auth::logout();

?>