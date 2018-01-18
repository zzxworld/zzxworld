# -*- coding: utf-8 -*-

import os
from fabric.api import env, run, cd

env.deploy_path = 'your/deploy/path'
env.src_path = os.path.join(env.deploy_path, 'src')

def deploy():
    """部署应用
    """
    with cd(env.src_path):
        run('ls -l')
