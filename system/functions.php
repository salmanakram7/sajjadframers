<?php
//Custom Functions


// Stock Label Manager

//TODO Update Stock Manager
function stock_manager($no_length_foot) {

echo ' <td  style="color: #ff5d48;font-weight: bolder;background-color: #ff5d48;">';
echo $no_length_foot."  &nbsp &nbsp &nbsp &nbsp<button class='btn btn-danger btn-sm' href='#'>Sold Out</button>";
echo ' </td>';

}

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