<?php
session_start();
/**
 * Created by PhpStorm.
 * User: itssa
 * Date: 1/7/2017
 * Time: 3:52 PM
 */

$arraypush = array_push($_SESSION[['push1']], 'push2');

var_dump($arraypush);
