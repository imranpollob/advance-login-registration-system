<?php

/********* helper function *********/

function clean($string){
    return htmlentities($string);
}

function redirect($location){
    return header("Location: {$location}");
}

function set_message($message){
    if (!empty($message)){
        $_SESSION['message'] = $message;
    }else{
        $message = "";
    }
}

function display_message(){
    if (isset($_SESSION['message'])){
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

function token_generator(){
    $token = $_SESSION['token'] = md5(uniqid(mt_rand(),true));
    return $token;
}

function send_email($email, $subject, $msg, $header){
    return mail($email, $subject, $msg, $header);
}

/********* validation function *********/



function username_exists($username){
    $sql = "SELECT username FROM users WHERE username='$username' ";
    $result = query($sql);

    if (row_count($result) == 1){
        return true;
    }else{
        return false;
    }
}

function email_exists($email){
    $sql = "SELECT email FROM users WHERE email='$email' ";
    $result = query($sql);

    if (row_count($result) == 1){
        return true;
    }else{
        return false;
    }
}

function validation_errors($error_message){

    $error_message = '<div class="col-lg-6 col-lg-offset-3 alert alert-dismissible alert-warning">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <h4>Warning!</h4>
                      <p>'.$error_message.'</p></div>';
    return $error_message;
}

function validate_user_registration(){

    $errors = [];

    $min = 3;
    $max = 20;

    if ($_SERVER['REQUEST_METHOD'] == "POST"){

        $first_name         = clean($_POST['first_name']);
        $last_name          = clean($_POST['last_name']);
        $username           = clean($_POST['username']);
        $email              = clean($_POST['email']);
        $password           = clean($_POST['password']);
        $confirm_password   = clean($_POST['confirm_password']);

        if (strlen($first_name) <$min){
            $errors[] = "You first name cant be less than {$min} characters";
        }

        if (strlen($first_name) > $max){
            $errors[] = "You first name cant be more than {$max} characters";
        }

        if (strlen($last_name) <$min){
            $errors[] = "You first name cant be less than {$min} characters";
        }

        if (strlen($last_name) > $max){
            $errors[] = "You first name cant be more than {$max} characters";
        }

        if (strlen($username) <$min){
            $errors[] = "You first name cant be less than {$min} characters";
        }

        if (strlen($username) > $max){
            $errors[] = "You first name cant be more than {$max} characters";
        }

        if (username_exists($username)){
            $errors[] = "Sorry, Username already taken";
        }

        if (email_exists($email)){
            $errors[] = "Sorry, Email already taken";
        }

        if ($password != $confirm_password){
            $errors[] = "Password does not match";
        }



        if (!empty($errors)){

            foreach ($errors as $err){
                echo validation_errors($err);
            }
        }else{
            // register the user
            if(register_user($first_name, $last_name, $username, $email, $password)){
                //providing confirmation message to session
                set_message('<div class="alert alert-dismissible alert-success">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <h4>Confirmation email is sent</h4>
                            <p>Please check you inbox and spam folder</p></div>');

                //redirecting to index.php
                redirect("index.php");
            }else{
                echo "Registration failed";
            }

        }

    }
}//validate_user_registration
 

function register_user($first_name, $last_name, $username, $email, $password){
    $first_name     = escape($first_name);
    $last_name      = escape($last_name);
    $username       = escape($username);
    $email          = escape($email);
    $password       = escape($password);

    $password = md5($password);
    $validation_code = md5($username . microtime());


    $query = "INSERT INTO users(first_name, last_name, username, email, password, validation_code, active) ";
    $query.= "VALUES('$first_name','$last_name','$username','$email','$password','$validation_code',0)";

    $result = query($query);
    confirm($result);

    //send mail

    $subject = "Activate Account";
    $msg = "Please click the link below to activate your account.
    http://localhost/login/activate.php?email=$email&code=$validation_code";
    $header = "From: noreply@yourwebsite.com";
    //send_email($email, $subject, $msg, $header);


    return true;
}


function activate_user(){
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        if (isset($_GET['email'])){
            $email = escape(clean($_GET['email']));
            $validation_code = escape(clean($_GET['code']));

            $sql = "SELECT id FROM users WHERE email='".$email."' AND validation_code='".$validation_code."' ";
            $result = query($sql);
            confirm($result);

            if (row_count($result) == 1){
                $sql = "UPDATE users SET active=1 ,validation_code=0 WHERE email='".$email."' AND validation_code='".$validation_code."' ";
                $result = query($sql);
                confirm($result);

                set_message("<p class='bg-success'>Your account has been activated. Please login</p>");
                redirect("login.php");
            }else{
                set_message("<p class='bg-danger'>Your account could not be activated.</p>");
                redirect("login.php");
            }
        }
    }
}

/******************** validate user login ****************/

function validate_user_login()
{
    $errors = [];

    $min = 3;
    $max = 20;

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $email              = clean($_POST['email']);
        $password           = clean($_POST['password']);
        $remember           = isset($_POST['remember']);

        if (empty($email)){
            $errors[] = "Email field can not be empty";
        }

        if (empty($password)){
            $errors[] = "Password field can not be empty";
        }


        if (!empty($errors)){

            foreach ($errors as $err){
                echo validation_errors($err);
            }
        }else{

           if (login_user($email, $password, $remember)){
                redirect("admin.php");
           }else{
               echo validation_errors("Your credentials are not correct");
           }

        }
    }

}


/**************** user login functions ***********/

function login_user($email, $password, $remember){

    $sql = "SELECT password FROM users WHERE email='".escape($email)."' AND active=1 ";
    $result = query($sql);
    confirm($result);

    if (row_count($result) == 1){
        $row = fetch_array($result);
        $db_password = $row['password'];

        if (md5($password) === $db_password){

            if ($remember == "on"){
                setcookie('email', $email, time()+86400); // cookie lifetime 86400 seconds
            }

            $_SESSION['email'] = $email;

            return true;
        }else{
            return false;
        }


    }else{
        return false;
    }
}


function logged_in(){
    if ($_SESSION['email'] || isset($_COOKIE['email'])){
        $_SESSION['email'] = $_COOKIE['email'];
        return true;
    }else{
        return false;
    }
}


/************ recover password ********/

function recover_password(){
    if ($_SERVER['REQUEST_METHOD'] == "POST"){

        if (isset($_SESSION['token']) &&  $_POST['token'] === $_SESSION['token']){

            $email = clean($_POST['email']);

            if (email_exists($email)){

                //$validation_code = md5(uniqid(mt_rand(),true));
                $validation_code = md5($email + microtime());
                setcookie('temp_access_code', $validation_code, time()+60);

                $sql = "UPDATE users SET validation_code=  '".escape($validation_code)."' WHERE email='".escape($email)."'  ";
                $result = query($sql);
                confirm($result);


                $subject = "Please reset your password";
                $msg = "Here is your password reset code {$validation_code}
                Click here to reset your password http://localhost/code.php?email=$email&code=$validation_code
                
                ";
                $header = "From: noreply@yourwebsite.com";

                if(!send_email($email, $subject, $msg, $header)){

                    echo validation_errors("Email could not be sent");
                }

                set_message("<p class='bg-success'>Please check your email for password reset code</p>");
                //redirect("index.php");

                //echo("$email $subject $msg $header");
                echo "localhost/login/code.php?email=$email&code=$validation_code";
            }else{
                echo validation_errors("Email doesn't exist");
            }

        }else{ //token failed
            redirect("index.php");
        }


    }
}


function validation_code(){
    if (isset($_COOKIE['temp_access_code'])){

        if (!isset($_GET['email']) && !isset($_GET['code'])){
            redirect("index.php");
        }else if (empty($_GET['email']) && empty($_GET['code'])){

        }else{

            if (isset($_POST['code'])){
                $email = clean($_GET['email']);
                $validation_code = clean($_POST['code']);

                $sql = "SELECT id FROM users WHERE validation_code='".escape($validation_code)."' AND email='".escape($email)."' ";
                $result = query($sql);
                confirm($result);

                if (row_count($result) == 1){
                    redirect("reset.php");
                }else{
                    echo validation_errors("Sorry wrong validation code");
                }
            }
        }

    }else{
        set_message("<p class='bg-success'>Sorry your validation time is expired</p>");
        redirect("recover.php");
    }
}