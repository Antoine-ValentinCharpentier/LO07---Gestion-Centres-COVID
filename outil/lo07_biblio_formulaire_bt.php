<?php

// 20/03/2019 : bibliotheque fonctions formulaire avec bootstrap
// Marc LEMERCIER


// =========================
// form_begin
// =========================

function form_begin($class, $method, $action) {
    echo ("\n<!-- ============================================== -->\n");
    echo ("<!-- form_begin : $class $method $action) -->\n");
    printf("<form class='%s' method='%s' action='%s'>\n", $class, $method, $action);
}

// =========================
// form_input_text
// =========================

function form_input_text($label, $name, $size, $value) {
    echo ("<div class='form-group'>");
    echo (" <label for='$label'>$label</label>");
    echo (" <input type='text' class='form-control' name='$name' size='$size' value='$value' >");
    echo ("</div>");
}

// =========================
// form_input_number
// =========================

function form_input_number($label, $name, $value) {
    echo ("<div class='form-group'>");
    echo (" <label for='$label'>$label</label>");
    echo (" <input type='number' class='form-control' name='$name' value='$value' >");
    echo ("</div>");
}

// =========================
// form_select
// =========================

// Parametre $label    : permet un affichage (balise label)
// Parametre $name     : attribut pour identifier le composant du formulaire
// Parametre $multiple : si cet attribut n'est pas vide alors sélection multiple possible
// Parametre $size     : attribut size de la balise select
// Parametre $liste    : un liste d'options. Vous utiliserez un foreach pour générer les balises option

function form_select($label, $name, $multiple, $size, $liste) {
    echo ("<div class='form-group'>");
    echo (" <label for='$label'>$label</label>");
    
    if($multiple != ""){
        echo (" <select class='form-control' name='$name' size='$size' multiple>");
    }else{
        echo (" <select class='form-control' name='$name' size='$size'>");
    }
    
    //le compteur $i permet de sélectionné la première valeur de la liste des options
    $i = 0;
    foreach($liste as $value_option){
        if($i == 0){
            echo ("<option value='$value_option' selected>$value_option</option>");
        }else{
            echo ("<option value='$value_option'>$value_option</option>");
        }
        $i++;
    }
    echo (" </select>");
    echo ("</div>");
}

//génère un menu sélect a partir d'une liste d'objet (provenant d'une table)
function form_select_table($label, $name, $multiple, $size, $liste) {
    echo ("<div class='form-group'>");
    echo (" <label for='$label'>$label</label>");
    
    if($multiple != ""){
        echo (" <select class='form-control' name='$name' size='$size' multiple>");
    }else{
        echo (" <select class='form-control' name='$name' size='$size'>");
    }
    
    //le compteur $i permet de sélectionné la première valeur de la liste
    $i = 0;
    foreach($liste as $item){
        if($i == 0){
            echo '<option value="'.$item->getId().'" selected>'.implode(" : ", (array)($item)).'</option>';
        }else{
            echo '<option value="'.$item->getId().'">'.implode(" : ", (array)($item)).'</option>';
        }
        $i++;
    }
    echo (" </select>");
    echo ("</div>");
}

// =========================

function form_input_reset($value) {
    echo ("<input type='reset' value='$value'>");
}

// =========================

function form_input_submit($value) {
    echo ("<input class='btn btn-primary' type='submit' value='$value'>");
}

// =========================

function form_input_hidden($name,$value) {
    echo ("<input type='hidden' name='$name' value='$value'>");
}

// =========================


function form_end() {
    echo ("</form>");
}

// =========================

?>


