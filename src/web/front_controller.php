<?php
session_start();
require_once '../routing.php';
require_once '../controllers.php';
require_once '../dispatcher.php';

$action_url = $_GET['action'];
dispatch($routing, $action_url);