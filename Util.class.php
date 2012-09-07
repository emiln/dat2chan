<?php
class Util {
    static function sanitize($string) {
        return $string;
    }

    static function is_mapped($module) {
        if (self::$map == null) {
            //self::$map = Config::controller_map();
            return false;
        }
        return array_key_exists($module, self::$map);
    }

    static function map_to_controller($module) {
        if (self::$map == null) {
            self::$map = Config::controller_map();
        }
        if (array_key_exists($module, self::$map)) {
            return self::$map[$module];
        } else {
            return $module;
        }
    }
    private static $map = null;
}
