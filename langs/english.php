<?php



function array_push_assoc($array, $key, $value){
    $array[$key] = $value;
    return $array;
 }


function lang($txt){

include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';


 $query = "SELECT i_eng FROM items";
 $result = mysqli_query($con, $query);

// DYNAMIC ARRAY
$dbarray=array();
 if (mysqli_num_rows($result) > 0){

     while ($row1 = mysqli_fetch_assoc($result)) {
            $eng=$row1['i_eng'];
            $dbarray = array_push_assoc($dbarray, $eng, $eng);

        }
 }
 else{
    $dbarray=array();
 }

// print_r($myarray);

// STATIC ARRAY
$lang = array(
    'FARMACY' => 'FARMACY',
    'POLICY' => 'POLICY',
    'CONTACT US' => 'CONTACT US',
    'REGISTER' => 'REGISTER',
    'LOGIN' => 'LOGIN',
    'Search' => 'Search',
    'add_to_cart' => 'ADD TO CART',
    'quantity'=> 'QUANTITY',
    'login'=> 'Login',
    'login_btn'=> 'Login',
    'mobile'=> 'Mobile Number',
    'password'=> 'Password',
    'forgot_pass'=> 'Forgot Password',
    'sign_up'=>'Sign Up Your Account',
    'fname'=>'First Name',
    'lname'=>'Last Name',
    'email'=>'Email Id',
    'pin'=>'Pincode',
    'delivery'=>'Delivery Address',
    "enter_password"=>"Enter Password",
    're_enter_pass'=>'Re enter Password',
    'new_pass'=>'New Password',
    're_enter_new_pass'=>'Re-enter New Password',
    'products'=>'Products',
    'get_location'=>'Get Location',
    'send'=>'Send',
    'verify_code'=>'Enter Verification Code',
    'verify_button'=>'Verify-Code',
    'your_cart'=>'Your Cart',
    'enter_mob'=>'Enter Your Mobile Number',
    'my_orders'=>'My Orders',
    'hello'=>'Hello',
    'total_price'=>'Total Price',
    'price'=>'Price',
    'outofstock'=>'Out of Stock',
    'available'=>'Available',
    'logout'=>'Logout',
    'add_more_items'=>'Buy More',
    'add_new_item'=>'Add New Item',
    'name'=>'Name',
    'hname'=>"Name-in-Hindi",
    'mname'=>'Name-in-Marathi',
    'add'=>'ADD ITEM',
    'category'=>'Category',
    'type'=>'Type',
    'edit'=> 'EDIT',
    'edit_item'=> 'EDIT ITEM',
    'verify_email'=> 'VERIFY EMAIL',
    'change_verify_email'=> 'CHANGE AND VERIFY EMAIL',
    'all'=>'ALL'




    );


    if (mysqli_num_rows($result) > 0){
$final_array=array_merge($dbarray, $lang); // COMBINE ARRAY'S
return $final_array[$txt];

}
else{
// print_r($final_array);
return $lang[$txt];

}

}
?>
