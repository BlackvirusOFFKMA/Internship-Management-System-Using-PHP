<?php

function get_var($key,$default = "")
{

    if(isset($_POST[$key]))
    {
        return $_POST[$key];
    }

    return $default;
}

function get_select($key,$value)
{
    if(isset($_POST[$key]))
    {
        if($_POST[$key] == $value)
        {
            return "selected";
        }
    }

    return "";
}

function esc($var)
{
    return htmlspecialchars($var);
}

function random_string($length)
{
    $array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    $text = "";

    for($x = 0; $x < $length; $x++)
    {

        $random = rand(0,61);
        $text .= $array[$random];
    }

    return $text;
}

function get_date($date)
{

    return date("jS M, Y",strtotime($date));
}

function show($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function views_path($view)
{
    if(file_exists("../mvc/views/" . $view . ".inc.php"))
    {
        return ("../mvc/views/" . $view . ".inc.php");
    }else{
        return ("../mvc/views/404.view.php");
    }
}

function upload_image($FILES)
{
	if(count($FILES) > 0)
	{

		//we have an image
		$allowed[] = "image/jpeg";
		$allowed[] = "image/png";

		if($FILES['image']['error'] == 0 && in_array($FILES['image']['type'], $allowed))
		{
			$folder = "uploads/";
			if(!file_exists($folder)){
				mkdir($folder,0777,true);
			}
			$destination = $folder . time() . "_" . $FILES['image']['name'];
			move_uploaded_file($FILES['image']['tmp_name'], $destination);
			return $destination;
		}
		
	}

	return false;
}

//get avatar of user
function get_image($image,$gender = 'male')
{
	if(!file_exists($image)){
 		$image = ASSETS.'/user_female.jpg';
 		if($gender == 'male'){
 			$image = ASSETS.'/user_male.jpg';
 		}
 	}else
 	{
 		$class = new Image();
 		$image = ROOT . "/" . $class->profile_thumb($image);
 	}

 	return $image;
}

function convert_vi_to_en($str) {
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
    $str = preg_replace("/(đ)/", "d", $str);
    //$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
    return $str;
}

?>