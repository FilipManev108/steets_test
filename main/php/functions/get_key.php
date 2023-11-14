<?php

function getKey(): string {
    $env = parse_ini_file('../../../.env');
    return $env['ENCRYPTION_KEY'];
}