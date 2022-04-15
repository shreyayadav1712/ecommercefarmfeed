<?php


function array_push_assoc($array, $key, $value){
    $array[$key] = $value;
    return $array;
 }


function lang($txt){
include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
mysqli_set_charset($con, "utf8");

 $query = "SELECT i_eng,i_mar FROM items";
 $result = mysqli_query($con, $query);

// DYNAMIC ARRAY
$dbarray=array();
 if (mysqli_num_rows($result) > 0){

     while ($row1 = mysqli_fetch_assoc($result)) {
            $eng=$row1['i_eng'];
            $mar=$row1['i_mar'];
            $dbarray = array_push_assoc($dbarray, $eng, $mar);

        }
 }
 else{
    $dbarray=array();
 }
// print_r($myarray);

// STATIC ARRAY
$lang = array(
    'FARMACY' => 'फार्मसी',
    'POLICY' => 'धोरण',
    'CONTACT US' => 'आमच्याशी संपर्क साधा',
    'REGISTER' => 'नोंदणी करा',
    'LOGIN' => 'लॉगिन करा',
    'Search' => 'शोध',
    'add_to_cart' => 'कार्टमध्ये जोडा',
    'quantity' =>'प्रमाण',
    'login'=> 'लॉगिन करा',
    'login_btn'=> 'लॉगिन',
    'mobile'=> 'मोबाइल नंबर',
    'password'=> 'पासवर्ड',
    'forgot_pass'=> 'पासवर्ड विसरलात',
    'sign_up'=>'आपले खाते साइन अप करा',
    "fname"=>"पहिले-नाव",
    'lname'=>'आडनाव',
    'email'=>'ई-मेल-आयडी',
    'pin'=>'पिन-कोड',
    'delivery'=>'डिलिवरी-पत्ता',
    "enter_password"=>"पासवर्ड-टाका",
    "re_enter_pass"=>"पुन्हा-पासवर्ड-टाका",
    'new_pass'=>'नवीन पासवर्ड-टाका',
    're_enter_new_pass'=>'पुन्हा-नवीन-पासवर्ड-टाका',
    'products'=>'उत्पादने',
    'get_location'=>'आपले-स्थान',
    'send'=>'पाठवा',
    'verify_code'=>'तुमचा-कोड-टाका',
    'verify_button'=>'कोड-तपासा',
    'enter_mob'=>'मोबाइल नंबर टाका',
    'my_orders'=>'माझी ऑर्डर',
    'hello'=>'नमस्कार',
    'your_cart'=>'आपले कार्ट',
    'total_price'=>'एकूण किंमत',
    'price'=>'किंमत',
    'outofstock'=>'साठा संपला',
    'available'=>'उपलब्ध',
    'logout'=>'लॉग आउट',
    'add_more_items'=>'अधिक खरेदी करा',
    'add_new_item'=>'Add New Item',
    'name'=>'इंग्रजी-मध्ये-नाव',
    'hname'=>"हिंदी-मध्ये-नाव",
    'mname'=>'मराठी-मध्य-नाव',
    'add'=>'सामान जोडा',
    'category'=>'श्रेणी',
    'type'=>'प्रकार',
    'edit'=>'संपादन करा',
    'edit_item'=>'आयटम संपादित करा',
    'change_verify_email'=> 'ईमेल बदला आणि सत्यापित करा',
    'verify_email'=> 'ईमेल सत्यापित करा',
    'all'=>'सर्व'









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
