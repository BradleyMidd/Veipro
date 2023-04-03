<?php
ini_set('display_errors', '0');

ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

ini_set('log_errors', '1');

ini_set('error_log', '../../logs/fout_log');

error_log('Er is een fout opgetreden: ' . mysqli_connect_error() . " Error nummer: " . mysqli_connect_errno());
