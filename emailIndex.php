<?php
require 'vendor/autoload.php';
require_once('./php/Models/Message.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = 'reset';
} else {
    $action = strtolower($action);
}

switch ($action) {
    case 'reset':
        // Reset values for variables
        $first_name = '';
        $last_name = '';
        $email = '';

        // Load view
        include "twoStepEmail.php";
        break;
    case 'submit':
        // Copy form values to local variables
        $first_name = trim(filter_input(INPUT_POST, 'first_name'));
        $last_name = trim(filter_input(INPUT_POST, 'last_name'));
        $email = trim(filter_input(INPUT_POST, 'email'));

        // Set up email variables
        $to_address = $email;
        $to_name = $first_name . ' ' . $last_name;
        $from_address = 'helloworld1245603@gmail.com';
        $from_name = 'Coddesses';
        $subject = 'Password Manager - Your code';
        $body = '<p>This is your code to recover your password.</p>' .
                '<p>Sincerely,</p>' .
                '<p>Codesses</p>';
        $is_body_html = true;
        
        // Send email
        try {
            send_email($to_address, $to_name, 
                    $from_address, $from_name, 
                    $subject, $body, $is_body_html);
        } catch (Exception $ex) {
            $error = $ex->getMessage();
            include "twoStepEmail.php";
        }        
        break;
        
}
?>