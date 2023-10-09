<?php 

function sanitize ($somestring){
    $safe=strip_tags($somestring);
    $safe=Htmlspecialchars($safe);
    $safe=trim($safe);
    return $safe;
}

function sanitize_pass($somestring){
    $safe=strip_tags($somestring);
    $safe=Htmlspecialchars($safe);
    $safe=Htmlentities($safe);
    return $safe;
}
?>