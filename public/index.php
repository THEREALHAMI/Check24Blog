<?php
session_start();
include('../bootstrap.php');

$app = new Check24Framework\Application(include('../src/config/config.php'));
$app->init();
