<?php
namespace Deployer;

require 'recipe/symfony.php';

// Config

set('repository', 'git@github.com:rsteuber/symfony-example.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('161.35.157.190')
    ->set('remote_user', 'rsteuber')
    ->set('deploy_path', 'var/www/test1.top-feest.nl');

// Hooks

after('deploy:failed', 'deploy:unlock');
