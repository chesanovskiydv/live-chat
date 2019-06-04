<?php

if (!function_exists('to_dot_notation')) {

    /**
     * Transform key from array to dot syntax.
     *
     * @param mixed $key
     *
     * @return mixed
     */
    function to_dot_notation($key)
    {
        return str_replace(['.', '[]', '[', ']'], ['_', '', '.', ''], $key);
    }
}
