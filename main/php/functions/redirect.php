<?php

function checkPost(){
    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        echo 'Not a post request';
        die();
    }
}