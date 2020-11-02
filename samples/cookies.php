<?php

error_reporting(E_ALL);

setcookie('test_1', 1);
setcookie('test_2', 2, time() + 60);

var_dump($_COOKIE['test_2']);
