<?php
class ModelModuleGeo extends Model {
	
	public function smarty_function_get_city()
{  
    
    $city = false;

    if (isset($_COOKIE['city']))
        $city = $_COOKIE['city']; 
    
    if ($city && !empty($city))
        return $city;

    if (!$city || empty($city))
    {

        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != '127.0.0.1' && preg_match('#^([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})$#', $_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ipa[] = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        if (isset($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP'] != '127.0.0.1' && preg_match('#^([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})$#', $_SERVER['HTTP_CLIENT_IP']))
        {
            $ipa[] = $_SERVER['HTTP_CLIENT_IP'];
        }
        if (isset($_SERVER['REMOTE_ADDR']) && preg_match('#^([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})$#', $_SERVER['REMOTE_ADDR']))
        {
            $ipa[] = $_SERVER['REMOTE_ADDR'];
        }
        $ip = $ipa[0];
    }

    $url = 'http://194.85.91.253:8090/geo/geo.html';
    $cl = curl_init();
    $query = '<ipquery><fields><city/></fields><ip-list><ip>' . $ip . '</ip></ip-list></ipquery>';
    curl_setopt($cl, CURLOPT_URL, $url);
    curl_setopt($cl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($cl, CURLOPT_TIMEOUT, 1);
    curl_setopt($cl, CURLOPT_POST, 1);
    curl_setopt($cl, CURLOPT_POSTFIELDS, $query);
    $result = curl_exec($cl);
    curl_close($cl);
    preg_match("|<city>(.*?)</city>|", $result, $city);
    if (isset($city[1]))
        $city = iconv('windows-1251', 'utf-8', $city[1]);
    else
        $city = 'no_city';
     
       if ($city && $city != 'no_city')
        setcookie('city', $city, time()+3600*24*7, '/');
	else
	setcookie('city', $city, time()+600, '/');
	
    return $city;
}
	
}
?>