#!/usr/bin/env python
# -*- coding: utf-8 -*-

from tornado import ioloop
from tornado import web
from tornado import escape
import jieba

class HomeController(web.RequestHandler):
    def get(self):
        self.set_header('Content-type', 'application/json;charset=utf-8');
        self.write(escape.json_encode({
            'message': 'ok',
            'text': 'Segment Word Service.',
        }))

class SegmentController(web.RequestHandler):
    def post(self):
        self.set_header('Content-type', 'application/json;charset=utf-8');
        text = self.get_body_argument('text')
        words = jieba.cut(text)
        self.write(escape.json_encode({
            'message': 'ok',
            'words': [word for word in words if len(word)>1],
        }))

def makeApp():
    return web.Application([
        (r'/', HomeController),
        (r'/segment', SegmentController),
    ])

def main():
    app  = makeApp()
    app.listen(8181)
    ioloop.IOLoop.current().start()

if __name__ == "__main__":
    main()
