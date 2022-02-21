<?php

/**
 * @param string ...$params
 * @return bool
 */
function issetParam(string ...$params):bool {
    foreach ($params as $param) {
        if (!isset($_POST[$param])) {
            return false;
        }
    }
    return true;
}