<?php

require (__DIR__.'/vendor/autoload.php');
use Mailgun\Mailgun;


$mgClient = new Mailgun($config['mailgun']['key']);
