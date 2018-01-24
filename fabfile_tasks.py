# -*- coding: utf-8 -*-

import os
from fabric.api import env, run, cd

def deploy():
    """部署应用
    """
    src_path = os.path.join(env.deploy_path, 'src')
    with cd(src_path):
        run('git checkout master && git pull')
        run('composer install')
        run('npm run production')
        run('php artisan config:cache')
        run('php artisan cache:clear')
        run('php artisan route:clear')
        run('php artisan view:clear')
        run('php artisan queue:restart')

def migrate():
    """执行数据库迁移
    """
    src_path = os.path.join(env.deploy_path, 'src')
    with cd(src_path):
        run('git checkout master && git pull')
        run('php artisan migrate')
