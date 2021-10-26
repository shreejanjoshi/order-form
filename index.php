<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);

//we are going to use session variables so we need to enable sessions
session_start();

function whatIsHappening()
{
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

//your products with their price.
$sandwichs = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];

$drinks = [
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];

$totalValue = 0;

//1st the value of change is 0
$change = 0;

//When the url is clicked then read value
if (isset($_GET['food'])) {
    $change = $_GET['food'];
}

//there is no value in change show drinks
if (!$change) {
    $products = $drinks;
} else { //show sandwichs when it show value
    $products = $sandwichs;
}

// var_dump($products);

//error variables to holds error messages

function test_input($data) {

    // trim removes special characters, but can also be specified to trim certain letters in a string.
    $data = trim($data);
    // removes any slashes that might occur.
    $data = stripslashes($data);
    // Convert the predefined characters "<" (less than) and ">" (greater than) to HTML entities.
    $data = htmlspecialchars($data);
    return $data;
}

$emailErr = $streetErr = $streetNumberErr = $cityErr = $zipCodeErr = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //email is empty
    if(empty($_POST['email'])){
        $emailErr = "email is required";
    }else{
        $email = test_input($_POST['email']);
        
        //check the format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    //street is empty
    if(empty($_POST['street'])){
        $streetErr = "street name is required";
    }else{
        $street = test_input($_POST['street']);

        //check format
        if (!preg_match("/^[a-zA-Z-' ]*$/",$street)) {
            $streetErr = "Only letters and white space allowed";
        }
    }

    //street number is empty
    if(empty($_POST['streetnumber'])){
        $streetNumberErr = "street number is required";
    }elseif(is_numeric($_POST['streetnumber'])){
        $streetNumber = test_input($_POST['streetnumber']);
    }else{
        $streetNumberErr = "street number must be a number";
    }

    //city is empty
    if(empty($_POST['city'])){
        $cityErr = "city is  namerequired";
    }else{
        $city = test_input($_POST['city']);

        //check format
        if (!preg_match("/^[a-zA-Z-' ]*$/",$street)) {
            $cityErr = "Only letters and white space allowed";
        }
    }

    //zipcode is empty
    if(empty($_POST['zipcode'])){
        $zipCodeErr = "zipcode is  namerequired";
    }elseif(is_numeric($_POST('zipcode'))){
        $zipCode = test_input($_POST['zipcode']);
    }else{
        $zipCodeErr =  "zipcode must be a number";
    }


   
}
// if (isset($_POST['button'])) {

//     $email = $_POST['email'];
//     $street = $_POST['street'];
//     $streetNumber = $_POST['streetnumber'];
//     $city = $_POST['city'];
//     $zipCode = $_POST['zipcode'];

//     if (empty($email) || empty($street) || empty($streetNumber) || empty($city) || empty($zipCode)) {
//         header("Location: ../form-view.php?error=emptyfields&email=" . $email . "&street=" . $street . "&streetnumber=" . $streetNumber . "&city=" . $city . "&zipcode=" . $zipCode);
//         exit();
//     } elseif (is_numeric($streetNumber) == false || is_numeric($zipCode) == false) {
//         header("Location: ../form-view.php?error=invalidnumber&email=" . $email . "street=" . $street . "&streetnumber=" . $streetNumber . "&city=" . $city . "&zipcode=" . $zipCode);
//     }
// }

require 'form-view.php';
