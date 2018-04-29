#!/usr/bin/env python
# -*- coding: utf-8 -*-

from fabric.api import local

def install():
    local('virtualenv venv')
    local('venv/bin/pip install -r requirements.txt')

def dev():
    local('venv/bin/python app.py')

def test():
    local('curl -X POST -d \'text="It was happily mapped to the Spring controller"\' 127.0.0.1:8181/segment')
