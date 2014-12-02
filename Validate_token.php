<?php
/**
 * Created by PhpStorm.
 * User: Prateek
 * Date: 12/1/2014
 * Time: 2:54 AM
 */

/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */

// array for JSON response
$response = array();


// connecting to db
$password = "pinguino";
$user = "ldituc2";
$db_database = "ldtcourses";

$connection = mysql_connect("ldtcourses.mysql.uic.edu", $user, $password)
    or die("Connection error: " . mysql_error());
mysql_select_db($db_database, $connection);

// check for post data
if (isset($_GET["token"])) {
    $token = $_GET['token'];
	$token2 = "\"" + $token + "\"";

    // get a product from products table
    $result = mysql_query("SELECT * FROM logToken WHERE token = $token2");
	//echo ($result)
	// Add a mysql_fetch_array method to fetch resulting array... Returns false on failure.

    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {

            $result = mysql_fetch_array($result);

            $product = array();
            $product["user"] = $result["user"];

            // success
            $response["success"] = 1;

            array_push($response["user"], $product);

            // echoing JSON response
            echo json_encode($response);
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No user found";

            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No user found";

        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}

?>