# -*- coding: utf-8 -*-

import os
from fabric.api import env, run, cd, sudo

def deploy(category=None):
    """部署应用
    """
    src_path = os.path.join(env.deploy_path, 'src')
    with cd(src_path):
        run('git checkout master && git pull')

        if category == 'frontend':
            run('npm run production')
        elif category == 'npm':
            run('npm i')
        elif category == 'migration':
            run('php artisan migrate')
        else:
            run('composer install')
            run('php artisan cache:clear')
            run('php artisan route:clear')
            run('php artisan view:clear')
            run('php artisan config:cache')
            run('php artisan queue:restart')
