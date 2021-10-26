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

//______________________________________________________
// var_dump($products);
//______________________________________________________

//error variables to holds error messages
function test_input($data)
{

    //
    $data = trim($data);
    //
    $data = stripslashes($data);
    //
    $data = htmlspecialchars($data);
    return $data;
}

$emailErr = $streetErr = $streetNumberErr = $cityErr = $zipCodeErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //email is empty
    if (empty($_POST['email'])) {
        $emailErr = "email is required";
    } else {
        $email = test_input($_POST['email']);

        //check the format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }

        // $_SESSION['email'] = $email;
    }

    //street is empty
    if (empty($_POST['street'])) {
        $streetErr = "street name is required";
    } else {
        $street = test_input($_POST['street']);
        $_SESSION['street'] = $street;
    }

    //street number is empty
    if (empty($_POST['streetnumber'])) {
        $streetNumberErr = "street number is required";
    } elseif (is_numeric($_POST['streetnumber'])) {
        $streetNumber = test_input($_POST['streetnumber']);
        $_SESSION['streetnumber'] = $streetNumber;
    } else {
        $streetNumberErr = "street number must be a number";
    }

    //city is empty
    if (empty($_POST['city'])) {
        $cityErr = "city is  namerequired";
    } else {
        $city = test_input($_POST['city']);
        $_SESSION['city'] = $city;
    }

    //zipcode is empty
    //_______________________________________________________
    // if (empty($_POST['zipcode'])) {
    //     $zipCodeErr = "zipcode is required";
    // } elseif (is_numeric($_POST('zipcode'))) {
    //     $zipCode = test_input($_POST['zipcode']);
    //     $_SESSION['zipcode'] = $zipCode;
    // } else {
    //     $zipCodeErr =  "zipcode must be a number";
    // }
    //____________________[a-zA-Z\d]{3}________________
    if (empty($_POST["zipcode"]) || !preg_match('/^[0-9]+$/', $_POST["zipcode"])) {
        $zipCodeErr = " Zipcode is required";
    } else {
        $zipCode = ($_POST["zipcode"]);
        $_SESSION['zipcode'] = $zipCode;
    }
}
//___________________________________________________________
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
//______________________________________________________________________

require 'form-view.php';
