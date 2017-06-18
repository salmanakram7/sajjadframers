<?php
//Custom Functions
function strafter($string, $substring)
{
    $pos = strpos($string, $substring);
    if ($pos === false)
        return $string;
    else
        return (substr($string, $pos + strlen($substring)));
}

function strbefore($string, $substring)
{
    $pos = strpos($string, $substring);
    if ($pos === false)
        return $string;
    else
        return (substr($string, 0, $pos));
}

function convert_to_inch($quan , $size)
{
    $output = $quan * $size * 12;
    return $output;


}

?>