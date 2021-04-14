<?php


function mt($name, $content, $additional = []){
    $str = '<meta name="' . $name . '" content="' . $content . '"';
    foreach ($additional as $item => $value) {
        $str .= " $item=\"$value\"";
    }
    return $str . '>';
}

function def($cond, $def = null){
    if ($cond){
        return $cond;
    }
    return $def;
}
