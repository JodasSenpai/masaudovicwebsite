<?php

function smart_asset($path) {
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $minPath = preg_replace("/\.$ext$/", ".min.$ext", $path);
    $fileToUse = file_exists($_SERVER['DOCUMENT_ROOT'] . $minPath) ? $minPath : $path;

    return $fileToUse;
}

function smart_css($path) {
    return '<link rel="stylesheet" href="' . smart_asset($path) . '">';
}

function smart_js($path, $attributes = '') {
    return '<script src="' . smart_asset($path) . '" ' . $attributes . '></script>';
}
