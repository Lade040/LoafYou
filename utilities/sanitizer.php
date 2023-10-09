<?php 
// sanitizer  for input fields
function sanitize ($somestring){
    $safe=strip_tags($somestring);
    $safe=Htmlspecialchars($safe);
    $safe=Htmlentities($safe);
    $safe=trim($safe);
    return $safe;
}

// sanitizer for passwords
function sanitize_pass($somestring){
    $safe=strip_tags($somestring);
    return $safe;
}
?>