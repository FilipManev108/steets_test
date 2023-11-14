<?php

function checkPost(): void {
    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        echo 'Not a post request';
        die();
    }
}