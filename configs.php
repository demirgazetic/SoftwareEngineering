<?php
require_once 'vendor/autoload.php';

foreach($_ENV as $key => $val) {
  define($key, $val);
}