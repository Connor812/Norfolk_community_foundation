<?php
require_once("../config-url.php");
session_start();

$_SESSION = array();

session_destroy();

header("Location: " . BASE_URL . "index.php");