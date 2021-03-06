#!/usr/bin/env php
<?php

if (empty($argv[1]) || !in_array($argv[1], array('start', 'stop', 'restart'))) {
    die("не указан параметр (start|stop|restart)\r\n");
}

$config = array(
    'class' => 'Game2WebsocketDaemonHandler',
    'pid' => '/tmp/websocket_game2.pid',
    'websocket' => 'tcp://127.0.0.1:8003',
    //'localsocket' => 'tcp://127.0.0.1:8010',
    //'master' => 'tcp://127.0.0.1:8020',
    //'eventDriver' => 'event',
    'timer' => 0.1
);

set_include_path(get_include_path() . PATH_SEPARATOR . realpath('../../../'));

spl_autoload_register(function ($class) { include $class . '.php'; });

$WebsocketServer = new WebsocketServer($config);
call_user_func(array($WebsocketServer, $argv[1]));