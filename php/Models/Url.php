<?php
namespace Codesses\php\Models
// File created by Sandra Kupfer 2021/03.
{
    use Codesses\php\Models\Model;
    require_once "Model.php";

    class Url extends Model
    {
        const COLUMN_URL_ID = "url_id";
        const COLUMN_URL = "url";
        const COLUMN_USER_NAME = "user_name";
        const COLUMN_USER_ID = "user_id";
        const COLUMN_PASSWORD = "password";
        const COLUMN_PASSWORD_HINT = "password_hint";
        
        // There should be one item for every column in the database.
        public static array $columnNames = array( 
            self::COLUMN_URL_ID,
            self::COLUMN_URL,
            self::COLUMN_USER_NAME,
            self::COLUMN_USER_ID,
            self::COLUMN_PASSWORD,
            self::COLUMN_PASSWORD_HINT,
        );

        // These correspond to the names of the input fields of your form.
        // They may or may not be the same as the associated columns in the database, but if they are not,
        // you will need to deal with that manually. See createUser( $params ) below.
        public static array $inputNames = array( 
            self::COLUMN_URL,
            self::COLUMN_USER_NAME,
            self::COLUMN_USER_ID,
            self::COLUMN_PASSWORD,
            self::COLUMN_PASSWORD_HINT,
        );

        public function __construct()
        {
            parent::__construct( "url", self::COLUMN_URL_ID, self::$columnNames );
        }

        // Syntactic sugar.
        public function getNumUrls()
        {
            return parent::getNumRows();
        }

        // Syntactic sugar.
        public function getAllUrls()
        {
            return parent::getRowObjects();
        }

        // Syntactic sugar.
        public function getUrlsWhere( $columnName, $value )
        {
            return parent::getRowObjectsWithValue( $columnName, $value );
        }

        // Syntactic sugar.
        // $id: the unique primary key of the url.
        public function getUrl( $id )
        {
            return parent::getRowObject( $id );
        }

        // Syntactic sugar.
        // $id: the unique primary key of the url.
        public function deleteUrl( $id )
        {
            return parent::deleteRow( $id );
        }

        public function createUrl( $params )
        {
            return parent::addRow( $params );
        }

    }
}
?>