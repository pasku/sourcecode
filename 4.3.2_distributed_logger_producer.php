#!/usr/bin/env php
<?php

require_once('../amqp.inc');
include_once('./default_amqp_conf.php');

$exchange = 'logs_exchange';

$conn = new AMQPConnection(HOST, PORT, USER, PASS);
$ch = $conn->channel();
$ch->access_request("/", false, false, true, true);

$msg_body = $argv[1];

$msg = new AMQPMessage($msg_body, array('content_type' => 'text/plain'));
$ch->basic_publish($msg, $exchange);

$ch->close();
$conn->close();
?>