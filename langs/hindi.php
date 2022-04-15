<?php


function array_push_assoc($array, $key, $value){
    $array[$key] = $value;
    return $array;
 }


function lang($txt){
include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';

mysqli_set_charset($con, "utf8");
 $query = "SELECT i_eng,i_hin FROM items";
 $result = mysqli_query($con, $query);

// DYNAMIC ARRAY
$dbarray=array();
 if (mysqli_num_rows($result) > 0){

     while ($row1 = mysqli_fetch_assoc($result)) {
            $eng=$row1['i_eng'];
            $hin=$row1['i_hin'];
            $dbarray = array_push_assoc($dbarray, $eng, $hin);

        }
 }
 else{
    $dbarray=array();
 }

// print_r($myarray);

// STATIC ARRAY
$lang = array(
    'FARMACY' => 'फार्मेसी',
    'POLICY' => 'नीति',
    'CONTACT US' => 'संपर्क करें',
    'REGISTER' => 'रजिस्टर करें',
    'LOGIN' => 'लॉग इन करें',
    'Search' => 'खोज',
    'add_to_cart' => 'कार्ट में डालें',
    'quantity'=> 'मात्रा',
    'login'=> 'लॉग इन करें',
    'login_btn'=> 'लॉग इन',
    'mobile'=> 'मोबाइल नंबर',
    'password'=> 'पासवर्ड',
    'forgot_pass'=> 'पासवर्ड भूल गये',
    'sign_up'=>'अपना खाता साइन अप करें',
    'fname'=>'पहला-नाम',
    'lname'=>'उपनाम',
    'email'=>'ईमेल-आईडी',
    'pin'=>'पिन-कोड',
    'delivery'=>'डिलिवरी-का-पता',
    'enter_password'=>'पासवर्ड-दर्ज-करें',
    'new_pass'=>'नया-पासवर्ड',
    're_enter_new_pass'=>'नया-पासवर्ड-पुनः-दर्ज-करें',
    're_enter_pass'=>'फिरसे-पासवर्ड-दर्ज-करें',
    'products'=>'उत्पादों',
    'get_location'=>'आपकी-स्थिति',
    'send'=>'भेजें',
    'verify_code'=>'आपका-कोड-लिखे',
    'verify_button'=>'कोड-की-जांच-करें',
    'enter_mob'=>'मोबाइल नंबर दर्ज करें',
    'my_orders'=>'मेरा ऑर्डर',
    'hello'=>'हैलो',
    'your_cart'=>'आपका कार्ट',
    'total_price'=>'कुल कीमत',
    'price'=>'कीमत',
    'outofstock'=>'स्टॉक ख़त्म',
    'available'=>'उपलब्ध',
    'logout'=>'लॉग आउट',
    'add_more_items'=>'और खरीदें',
    'add_new_item'=>'नया आइटम जोड़ें',
    'name'=>'नाम-अंग्रेजी-में',
    'hname'=>"नाम-हिंदी-में",
    'mname'=>'मराठी-में-नाम',
    'add'=>'आइटम जोड़ें',
    'category'=>'श्रेणी',
    'type'=>'प्रकार',
    'edit'=>'संपादित करें',
    'edit_item'=>'संपादित आइटम',
    'change_verify_email'=> 'ईमेल बदलें और सत्यापित करें',
    'verify_email'=> 'ईमेल सत्यापित करें',
    'all'=>'सब'











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
