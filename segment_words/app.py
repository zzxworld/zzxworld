#!/usr/bin/env python
# -*- coding: utf-8 -*-

from flask import Flask
from flask import jsonify
from flask import request
import jieba

app = Flask(__name__)

@app.route('/')
def index():
    return jsonify({
        'message': 'ok',
        'name': 'segment word services.',
        })


@app.route('/segment', methods=['POST'])
def segment():
    text = request.form['text']
    words = jieba.cut(text)
    return jsonify({
        'message': 'ok',
        'words': [word for word in words if len(word)>1],
        })
