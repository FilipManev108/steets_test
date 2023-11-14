<?php

function checkPostRequest(): bool {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}