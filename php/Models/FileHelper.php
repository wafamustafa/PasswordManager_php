<?php

namespace Codesses\php\Models
{
    use Codesses\php\Models\{FP,Url};
    require_once "FormProcessor.php";
    require_once "Url.php";
    require_once "utl.php";


    class FileHelper 
    {
        const ERROR_TYPE_NO_FILE_SELECTED = 0;
        const ERROR_TYPE_NOT_CSV = 1;
        const ERROR_TYPE_FILE_NOT_FOUND = 2;

        const CSV_ARRAY_INDEX_URL = 0;
        const CSV_ARRAY_INDEX_USER_NAME = 1;
        const CSV_ARRAY_INDEX_PASSWORD = 2;
        
        public static $submitName = 'fileSubmit';
        public static $fileInputName = 'fileInput';
        public static $fileFormName = 'fileForm';

        public static $inputNames = array (
            "fileInput"
        );

        public static $errorMessages = array (
            "Please choose a file.",
            "Please select a file with a .csv extension.",
            "File was not uploaded."
        );

        public static function getSubmitName()
        {
            return self::$submitName;
        }

        public static function getUrlParams( $userId, $csvArray )
        {
            // Setting it up as an associative array first to make it easy to check
            // against Url::$inputNames.
            $urlArray = array (
                Url::COLUMN_URL         => $csvArray[ self::CSV_ARRAY_INDEX_URL ],
                Url::COLUMN_USER_NAME   => $csvArray[ self::CSV_ARRAY_INDEX_USER_NAME ],
                Url::COLUMN_USER_ID     => $userId,
                Url::COLUMN_PASSWORD    => $csvArray[ self::CSV_ARRAY_INDEX_PASSWORD ],
                Url::COLUMN_PASSWORD_HINT => ""
            );

            // Get just the values.
            $urlArray = array_values( $urlArray );

            return Url::getParams( Url::$inputNames, $urlArray );
        }
    }

    class FH extends FileHelper {}
}
?>