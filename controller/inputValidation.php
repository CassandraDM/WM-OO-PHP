<?php
function inputValidation($input)
{
    $pattern = '/^(?=.*\S).{2,100}$/';

    if (preg_match($pattern, $input)) {
        return true;
    }
    return false;
}
