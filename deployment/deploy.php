<?php

namespace Deployer;

require 'deployment/recipe/rsync.php';
require 'deployment/recipe/laravel.php';

ini_set('memory_limit', '512M');

inventory('deployment/hosts/config.yml');


set('composer_action', 'install');
set('composer_options', '{{composer_action}} --verbose --prefer-dist --no-interaction --no-dev --optimize-autoloader');

set('writable_use_sudo', true); // Using sudo in writable commands?
set('writable_recursive', true); // Common for all modes
set('writable_mode', 'chown');
set('writable_chmod_mode', '0775');
set('writable_chmod_recursive', true);
set('writable_chmod_with_chown', true);
set('default_timeout', 600);

set('http_user', 'deploy:www-data');

$deployEnv = getenv('DEPLOY_ENV');
host($deployEnv);

env('git_cache', true);

set('shared_dirs', [
    'storage/app',
    'storage/framework/cache',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
    'storage/sendpulse',
    'public/uploads',
]);

// Общие файлы
set('shared_files', ['.env']);

// Файлы для синхронизации
set('rsync_src', '.');
set('rsync', [
    'exclude' => [
        '.git*',
        'deploy.php',
        '.env',
        '.idea',
        '.circleci',
        'deployment',
        'node_modules',
    ],
    'exclude-file' => false,
    'include'      => [],
    'include-file' => false,
    'filter'       => [],
    'filter-file'  => false,
    'filter-perdir'=> false,
    'flags'        => 'rz', // Recursive, with compress
    'options'      => ['delete'],
    'timeout'      => 120,
]);


// desc('Execute custom deploy scenario');
// task('custom:deploy', function () {
//     run('cd {{release_path}} && sudo chmod +x ./deployment/scripts/install_front.sh && \
//     sudo ./deployment/scripts/install_front.sh');
// });
task('custom:down', function () {
    run('{{bin/php}} {{release_path}}/artisan down --message="Извините, ведутся технические работы."');
});
task('custom:up', function () {
    run('{{bin/php}} {{release_path}}/artisan up');
});

task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    //'deploy:update_code', // replaced with rsync
    'rsync',
    'deploy:shared',
    'deploy:vendors',
    'deploy:writable',
    'custom:down',
    'artisan:storage:link',
    'artisan:view:clear',
    'artisan:cache:clear',
    'artisan:config:cache',
    'artisan:route:cache',
    'artisan:optimize',
    'artisan:migrate',
    'artisan:db:seed',
    'custom:up',
    //'custom:deploy',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
]);
after('deploy', 'success');
after('deploy:failed', 'deploy:unlock');
