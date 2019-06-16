<?php

use Illuminate\Support\Collection;

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

if (!function_exists('keys_to_strings')) {

    /**
     * Transform keys from an array into a flat array with keys-strings.
     *
     * @param array $parameters
     * @param null|string $prefix
     *
     * @return Collection
     */
    function keys_to_strings(array $parameters, ?string $prefix = null): Collection
    {
        return collect($parameters)->mapWithKeys(function ($parameter, $key) use ($prefix) {

            if (is_array($parameter)) {
                $newParameters = [];
                foreach ($parameter as $parameterKey => $parameterValue) {

                    if (is_array($parameterValue)) {
                        $newParameter = $this->keys_to_strings($parameterValue, "{$key}[{$parameterKey}]")->toArray();
                    } else {
                        $newParameter = is_null($prefix)
                            ? ["{$key}[{$parameterKey}]" => $parameterValue]
                            : ["{$prefix}[{$key}][{$parameterKey}]" => $parameterValue];
                    }
                    $newParameters = array_merge($newParameters, $newParameter);
                }
                return $newParameters;
            }

            return is_null($prefix)
                ? [$key => $parameter]
                : ["{$prefix}[{$key}]" => $parameter];
        });
    }
}

if (!function_exists('route_name_to_translation_key')) {

    /**
     * @param string $routeName
     *
     * @return string
     */
    function route_name_to_translation_key(string $routeName): string
    {
        return 'titles.' . str_replace('::', '.', $routeName);
    }
}
