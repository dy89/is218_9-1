<?php
//set default values
$name = '';
$email = '';
$phone = '';
$message = 'Enter some data and click on the Submit button.';

//process
$action = filter_input(INPUT_POST, 'action');

switch ($action) {
    case 'process_data':
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');

        /*************************************************
         * validate and process the name
         ************************************************/
        // 1. make sure the user enters a name
        // 2. display the name with only the first letter capitalized
        $i = strpos($name, ' ');
        if(empty($name)) {
            $message = 'You must enter a name first.';
        }
        else if ($i === false)
        {
            $message = "You are missing a first or last name. Please re-enter your name.";
        }
        else
        {
            $name = strtolower($name);
            $name = ucwords($name);
            $first_name = substr($name, 0, $i);
            $last_name = substr($name, $i + 1);
            $name = $first_name . ' ' . $last_name;
        }

        /*************************************************
         * validate and process the email address
         ************************************************/
        // 1. make sure the user enters an email
        // 2. make sure the email address has at least one @ sign and one dot character
        $at = strpos($email, '@');
        $dot = strpos($email, '.');
        if($at === false || $dot === false)
        {
            $message .= "\nPlease enter a valid e-mail address."
        }
        /*************************************************
         * validate and process the phone number
         ************************************************/
        // 1. make sure the user enters at least seven digits, not including formatting characters
        // 2. format the phone number like this 123-4567 or this 123-456-7890
        if(strlen($phone) < 7){
            $message .="\nYou must enter a valid phone number.";
        }
        else if (!is_numeric($phone))
        {
            $message .="\nYou must enter a valid phone number."
        }
        else 
        {
            $part1 = substr($phone, 0, 3);
            $part2 = substr($phone, 3, 3);
            $part3 = substr($phone, 6);
            $formatphone = $part1 . '-' . $part2 . '-' . $part3;
        }
        /*************************************************
         * Display the validation message
         ************************************************/
        $message = <<<MESSAGE
        "Hello ${first_name}, \n
        Thank you for entering this data: \n \n
        Name: $name \n
        Email: $email \n
        Phone: $formatphone
MESSAGE;

        break;
}
include 'string_tester.php';
?>