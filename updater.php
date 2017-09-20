<?php

require 'vendor/autoload.php';

$env = new Dotenv\Dotenv(__DIR__);
$env->load();

$updater = new \App\HeadhunterResumeUpdater(
    getenv('RESUME_ID'),
    getenv('API_TOKEN')
);

$updater->update();