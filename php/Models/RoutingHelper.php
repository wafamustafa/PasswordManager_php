<?php

namespace Codesses\php\Models
{

use stdClass;

    class RoutingHelper 
    {
        private function __construct(){}

        public static $action = 'a';
        public static $actionCreate = "a1";
        public static $actionUpdate = "a2";
        public static $actionDelete = "a3";
        public static $actionView = "a4";
        public static $actionLogOut = "a5";

        public static $id = 'i';

        public static function getValue( $key )
        {
            return isset( $_GET[$key] ) ? $_GET[$key] : null;
        }

        public static function isCreate( $value )
        {
            return $value == self::$actionCreate;
        }

        public static function isUpdate( $value )
        {
            return $value == self::$actionUpdate;
        }

        public static function getActionCreate()
        {
            return self::$action . "=" . self::$actionCreate;
        }

        // TODO: refactor.
        public static function getActionUpdate( $id )
        {
            return self::$action . "=" . self::$actionUpdate . "&" . self::$id . "=" . $id;
        }

        public static function getActionDelete( $id )
        {
            return self::$action . "=" . self::$actionDelete . "&" . self::$id . "=" . $id;
        }
    }

    // Syntactic sugar.
    class RH extends RoutingHelper {}
}
?>