<?php

//helper functions version 1.0 6/14/2014 
function redirect_to($loc) {
    if ($loc != null) {
        header("Location: " . $loc);
        exit;
    }
}

function strip_zeros_from_date($marked_string = '') {
    $no_zeros = str_replace('*0', '', $marked_string);
    $cleaned_string = str_replace('*', '', $no_zeros);
    return $cleaned_string;
}

function output_message($message = '') {
    if (!empty($message)) {
        return "<p> class=\"message\"{$message}</p>";
    } else {
        return "";
    }
}
