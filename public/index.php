<?php
session_start();
include('../bootstrap.php');

$app = new Check24Framework\Application();
$app->init(include('../src/config/config.php'));
