<?php

namespace Shared\Common;

class Common {

    public static function dumpArray($input) {
        print "<PRE>";
        print_r($input);
        print "</PRE>";
    }

    public static function getValue($array, $index, $default = false) {
        if (isset($array[$index]) && !empty($array[$index])) {
            return $array[$index];
        }
        return $default;
    }

    public static function getConstant($name, $default = false) {
        if (defined($name)) {
            return constant($name);
        }
        return $default;
    }
}
