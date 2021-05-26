<?php

namespace Codesses\php\Models
{
    require_once "utl.php";

// Copied and modified from https://www.php.net/manual/en/function.session-start.php
// on 2021/04/10
class Session
{
    const SESSION_STARTED = PHP_SESSION_ACTIVE;
    const SESSION_NOT_STARTED = PHP_SESSION_NONE;

    // Make the class a singleton.
    private static $instance = null;
    private function __construct() {}
    public static function getInstance()
    {
        if( self::$instance == null ) {
            self::$instance = new Session;
        }

        self::doStart();
        return self::$instance;
    }

    private static function doStart()
    {
        if( self::getStatus() != self::SESSION_STARTED ) {
            session_start();
        }
    }

    private static function getStatus()
    {
        return session_status();
    }

    // Indicate whether the session has been started.
    public function isStarted()
    {
        return self::getStatus() == self::SESSION_STARTED;
    }

    public function hasUser()
    {
        return self::$instance->getUserId() != null;
    }

    public function getUserId()
    {
        return self::$instance->isStarted() ? self::$instance->__get( "user_id" ) : null;
    }

    /**
    *    (Re)starts the session.
    *   
    *    @return    bool    TRUE if the session has been initialized, else FALSE.
    **/
    public function startSession( $user_id )
    {
        if( !self::$instance->isStarted() ) {
            self::doStart();
        } 

        self::$instance->__set( "user_id", $user_id );
        return self::$instance->isStarted();
    }

    /**
    *    Stores datas in the session.
    *    Example: $instance->foo = 'bar';
    *   
    *    @param    name    Name of the datas.
    *    @param    value    Your datas.
    *    @return    void
    **/
    public function __set( $name , $value )
    {
        $_SESSION[$name] = $value;
    }

    /**
    *    Gets datas from the session.
    *    Example: echo $instance->foo;
    *   
    *    @param    name    Name of the datas to get.
    *    @return    mixed    Datas stored in session.
    **/
    public function __get( $name )
    {
        if( isset($_SESSION[$name]) ) {
            return $_SESSION[$name];
        }
    }

    public function __isset( $name )
    {
        return isset($_SESSION[$name]);
    }

    public function __unset( $name )
    {
        unset( $_SESSION[$name] );
    }

    /**
    *    Destroys the current session.
    *   
    *    @return    bool    TRUE is session has been deleted, else FALSE.
    **/
    public function destroy()
    {
        if( self::$instance->isStarted() ) {
            session_destroy();
            unset( $_SESSION );
            return self::$instance->isStarted();
        }

        return FALSE;
    }
}
}


?>