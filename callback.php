<?php
session_start();

include 'OAuth.php';

$oauth = new OAuth();

if (!isset($_GET['code'])) {
    echo "Oop! Something went wrong.<br>";
    $authorization_endpoint_URI = $oauth->getAuthorizationEndpointURI();
    echo "<a href='$authorization_endpoint_URI'>Please Retry.</a>";
}else{
    $authorization_code = $_GET['code'];
    $access_token = $oauth->requestAccessToken($authorization_code);
    $profile_info = $oauth->requestProfileInfo($access_token);

    $_SESSION['user_id'] = $profile_info['id'];
    $_SESSION['first_name'] = $profile_info['first_name'];
    $_SESSION['last_name'] = $profile_info['last_name'];
    $_SESSION['name'] = $profile_info['name'];

    if($access_token==""){
        echo "Error occurred while obtaining access token.<br>";
        echo "<a href='logout.php'>Please Retry.</a>";
    } else if(sizeof($profile_info)==0){
        echo "Error occurred while obtaining user data.<br>";
        echo "<a href='logout.php'>Please Retry.</a>";
    }else{
        header("Location: index.php");
    }
}

?>