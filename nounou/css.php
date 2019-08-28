<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Définition du fichier thème
define ('THEME_FOLDER', './health-center-master/');

// Ligne <link .... pour le css
function stylesheet ($fichier) {
    $res = "<link rel='stylesheet' type='text/css' href='" . THEME_FOLDER . "css/" . $fichier ."'> \n";
    echo $res;
    return $res;
            
};

function script ($fichier) {
    $res = " <script src=" . THEME_FOLDER . "js/" . $fichier . "></script>\n";
    echo $res;
    return $res;
};
