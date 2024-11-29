<?php
require_once '../vendor/autoload.php';

use App\Controllers\SlotMachineController;

$path = $_SERVER['REQUEST_URI'];

if ($path === '/slot-machine') {
    $controller = new SlotMachineController();
    $controller->show();
} elseif ($path === '/play') {
    $controller = new SlotMachineController();
    $controller->play();
} else {
    http_response_code(404);
    echo "404 Not Found";
}
