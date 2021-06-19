<?php

if (! function_exists('array_to_object')) {
    function array_to_object($array)
    {
        $obj = new stdClass;
        foreach ($array as $k => $v) {
            if (strlen($k)) {
                if (is_array($v)) {
                    $obj->{$k} = array_to_object($v);
                } else {
                    $obj->{$k} = $v;
                }
            }
        }
        return $obj;
    }
}
