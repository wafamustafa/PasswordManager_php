<?php
// File created by Sandra Kupfer 2021/03.

namespace Codesses\php\Models
{
    use Codesses\php\Models\{Model, RH};
    require_once "Model.php";
    require_once "RoutingHelper.php";

    class User extends Model
    {
        // There should be one item for every column in the database.
        public static array $columnNames = array( "user_id", "first_name", "last_name", "user_name", "email", "login_password", "recovery_email", "phone", "is_admin" );

        // These correspond to the names of the input fields of your form.
        // They may or may not be the same as the associated columns in the database, but if they are not,
        // you will need to deal with that manually. See createUser( $params ) below.
        public static array $inputNames = array( "user_id", "first_name", "last_name", "user_name", "email", "login_password", "password2" );

        public static array $loginNames = array( "user_name", "login_password" );

        // Error messages that correspond 1-to-1 with the input fields.
        public static array $errorMessages = array(
            "user_id" => "Please enter a valid user ID.",
            "first_name" => "Please enter a name that is a least two characters long and has only letters, hyphens, and apostrophes.",
            "last_name" => "Please enter a name that is a least two characters long and has only letters, hyphens, and apostrophes.",
            "user_name" => "That user name is already in use. Please enter a different user name.",
            "email" => "Please enter a valid email address.",
            "login_password" => "Please enter a password that is at least 8 characters long and contains at least one upper case letter, one number, and one special character.",
            "password2" => "Please enter a matching password."
        );

        // Error messages that correspond 1-1 with input fields for login.
        public static array $loginErrorMessages = array (
            "user_name" => "We were unable to find a user with that user name.",
            "login_password" => "That password does not match what we have for that user name.",
        );

        // Label text that correspond 1-to-1 with the input fields.
        public static array $labels = array(
            "user_id" => "User ID",
            "first_name" => "First name",
            "last_name" => "Last name",
            "user_name" => "User name",
            "email" => "Email",
            "login_password" => "Password",
            "password2" => "Repeat password"
        );

        public static array $updateInputNames = array( "first_name", "last_name", "user_name", "email" );
        public static array $createInputNames = array( "first_name", "last_name", "user_name", "email", "login_password", "password2" );

        public function __construct()
        {
            parent::__construct( "users", "user_id", self::$columnNames );
        }

        // Syntactic sugar.
        public function getNumUsers()
        {
            return parent::getNumRows();
        }

        // Syntactic sugar.
        public function getUsers()
        {
            return parent::getRowObjects();
        }

        // Syntactic sugar.
        public function getUsersWhere( $columnName, $value )
        {
            return parent::getRowObjectsWithValue( $columnName, $value );
        }

        // TODO: refactor with RH actions.
        // Syntactic sugar.
        public function getUser( $id )
        {
            return parent::getRowObject( $id );
        }

        // Syntactic sugar.
        public function deleteUser( $id )
        {
            return parent::deleteRow( $id );
        }

        // Syntactic sugar. Note that if the properties of the $params object do not correspond to 
        // database columns, the update will fail.
        // $params: An object with properties that are key/value pairs corresponding to columns in the database.
        public function updateUser( $params ) 
        {
            return parent::updateRow( $params );
        }

        // Create a new user using the provided key/value pairs. Modify the $params object so that 
        // the object properties correspond to the column names in the database.
        // Note that if the properties of the $params object do not correspond to 
        // database columns, the user will not be added.
        public function createUser( $params )
        {
            // This params object will likely be from the form processor, so make sure you add in values for the columns
            // that don't have input fields and unset value that don't correspond to a column, 
            // or call fixParams( $params, RH::$actionCreate ) first.

            return parent::addRow( $params );
        }

        public function doAction( $action, $params ) 
        {
            switch( $action ) {
                case RH::$actionCreate: 
                    return parent::addRow( $params );
                case RH::$actionUpdate: 
                    return parent::updateRow( $params );
                case RH::$actionDelete: 
                    return parent::deleteRow( $params );
                case RH::$actionView: 
                    return parent::getRowObject( $params );
            }            
        }

        // Make sure that the $params are appropriate for creating a new user.
        // $action: One of routing values in RoutingHelper.php.
        public function fixParams( $params, $action )
        {
            if( RH::isCreate( $action ) ) {
                unset( $params->user_id );
            }


            // Hash the password no matter what.
            if( isset( $params->login_password ) ) {
                $params->login_password = password_hash( $params->login_password, PASSWORD_DEFAULT );
            }

            // Get rid of the repeat password.
            unset( $params->password2 );

            return $params;
        }

        // Validate all of the key/value pairs in the $params object.
        // If everything is valid, return null. Otherwise, return the name of the 
        // invalid input.
        public function validateInput( $params, $action )
        {
            foreach( $params as $key=>$value ) {
                // Ignore the value for the id.
                if( $key == $this->idName ) {
                    continue;
                }

                // Compare password2 against the login_password.
                if( $key == "password2" ) {
                    if( strcmp( $params->login_password, $value ) != 0 ) {
                        return $key;
                    }
                    continue;
                }
                
                // Use the default validation if applicable.
                if( $this->hasValidationType( $key ) && !$this->isValidInput( $key, $value ) ) {
                    return $key;
                }

                // Do some additional validation for the user name.
                if( $key == "user_name" && sizeof( $this->getUsersWhere( $key, $value ) ) > 0 ) {
                    return $key;
                }
            }
            return null;
        }

        public function getTableHeadersRow( $getActions)
        {
            echo '
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">User Name</th>
                <th scope="col">Email</th>';
            if( $getActions ) {
                echo '
                <th scope="col"></th>
                <th scope="col"></th>';
            }

            echo '
            </tr>
            ';
        }

        public function getRowForUser( $user, $getActions )
        {
            $user_id = $user->user_id;
            $edit = RH::getActionUpdate( $user_id );
            $delete = RH::getActionDelete( $user_id );
            $rows = "
            <tr>
                <th>{$user_id}</th>
                <td>{$user->first_name} {$user->last_name}</td>
                <td>{$user->user_name}</td>
                <td>{$user->email}</td>";

            // TODO: refactor.
            if( $getActions ) {
                $rows .= "            
            <td>
                <form action=\"./account.php?{$edit}\" method=\"POST\">
                    <div class=\"inputDiv\">
                        <input type=\"hidden\" id=\"user_id\" name=\"user_id\" value=\"{$user_id}\">
                        <input type=\"submit\" value=\"Edit\">
                    </div>
                </form>
            </td>
            <td class=\"formTd\">
                <form action=\"./account.php?{$delete}\" method=\"POST\">
                    <div class=\"inputDiv\">
                        <input type=\"hidden\" id=\"user_id\" name=\"user_id\" value=\"{$user_id}\">
                        <input type=\"submit\" value=\"Delete\">
                    </div>
                </form>
            </td>";
            }

            $rows .= "
            </tr>";
            echo $rows;
        }

        public function getRowForUserId( $user_id, $getActions )
        {
            $user = $this->getUser( $user_id );
            return $this->getRowForUser( $user, $getActions );
        }

        public function getRowsForUsers()
        {
            $rows = "";
            $users = $this->getUsers();
            foreach( $users as $user ) {
                $rows .= $this->getRowForUser( $user, true );
            }
        }

        public function getInputElements( $inputName, $params, $errorMessages )
        {
            $showHide = $inputName == "login_password" || $inputName == "password2" ? "Show" : "";
            $labels = self::$labels;
            echo "
            <div id=\"{$inputName}Error\" class=\"errorDiv\">{$errorMessages[$inputName]}</div>
            <div class=\"inputDiv\">
              <label for=\"{$inputName}\">{$labels[$inputName]}</label>
              <input type=\"text\" name=\"{$inputName}\" id=\"{$inputName}\" value=\"{$params->$inputName}\" />
              <span class=\"showHideSpan\">{$showHide}</span>
            </div>
            ";
        }
    }
}
?>