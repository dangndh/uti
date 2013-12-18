<?php
class Uti
{

    /**
    * Leverages Vietnam Co., Ltd
    * @author           Nguyen Duong Hai Dang
    * @date created     2013 - 12 - 18
    * check if IP address exists in a network
    */
    public static function IPvsCIDR($user_ip, $cidr) 
    {
        $parts = explode('/', $cidr);
        $ipc = explode('.', $parts[0]);
        foreach ($ipc as &$v)
            $v = str_pad(decbin($v), 8, '0', STR_PAD_LEFT);
        $ipc = substr(join('', $ipc), 0, $parts[1]);
        $ipu = explode('.', $user_ip);
        foreach ($ipu as &$v)
            $v = str_pad(decbin($v), 8, '0', STR_PAD_LEFT);
        $ipu = substr(join('', $ipu), 0, $parts[1]);
        return $ipu == $ipc;
    }


    /**
    * Leverages Vietnam Co., Ltd
    * @author           Nguyen Duong Hai Dang
    * @date created     2013 - 10 - 16
    * 
    */
    public static function isUrl( $str )
    {
        
        $regex = "((https?|ftp)\:\/\/)?"; // SCHEME 
        $regex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?"; // User and Pass 
        $regex .= "([a-z0-9-.]*)\.([a-z]{2,3})"; // Host or IP 
        $regex .= "(\:[0-9]{2,5})?"; // Port 
        $regex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?"; // Path 
        $regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?"; // GET Query 
        $regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?"; // Anchor 

        if(preg_match("/^$regex$/", $str)) 
            return true;
        return false;

        //return preg_match('@^(?:http://)?([^/]+)@i', $str);
    }

    /**
    * Leverages Vietnam Co., Ltd
    * @author           Nguyen Duong Hai Dang
    * @date created     2013 - 10 - 16
    * 
    */
    public static function extractGoogleRedirectUrl( $googleLink )
    {
        $decodeStr = urldecode( $googleLink );
        $arrDomain = explode('url=', $decodeStr);

        if( !is_array( $arrDomain ) || empty( $arrDomain[1] ) )
            return NULL;

        $link = explode('&', $arrDomain[1] );        

        return  !empty( $link[0] )? $link[0] : NULL;

    }    

    /**
    * Leverages Vietnam Co., Ltd
    * @author           Nguyen Duong Hai Dang
    * @date created     2013 - 10 - 16
    * 
    */
    public static function extractDomain( $url )
    {
        $url = str_replace( 'https://', "", $url );
        preg_match('@^(?:http://)?([^/]+)@i', $url , $matches);
            
        $host = $matches[1];

        // get last two segments of host name
        preg_match('/[^.]+\.[^.]+$/', $host, $matches);
        return !empty( $matches[0] ) ? $matches[0] : NULL;
        
    }

    /**
    * Leverages Vietnam Co., Ltd
    * @author           Nguyen Duong Hai Dang
    * @date created     2013 - 10 - 10
    * 
    */
    public static function formatUrl( $url )
    {
        $res = preg_replace('~^(?:https?://)?(?:www[.])?~i', '', $url);
        $res = preg_replace('/\/$/', '', $res);
        return $res;
    }

    /**
    * Leverages Vietnam Co., Ltd
    * @author           Nguyen Duong Hai Dang
    * @date created     2013 - 10 - 08
    * 
    */
    public static function listIp2numeric( $arrIp )
    {
        if( ! is_array( $arrIp ) )
            return false;

        $lst = array();
        foreach( $arrIp as $ip )
            $lst[] = ApcUtility::ip2numeric( $ip );

        return $lst;
    }

	/**
    * Leverages Vietnam Co., Ltd
    *
    * @author             Truong Minh Hai
    * @date created       2013/06/24
    *
    * Convert ip to numeric
    */
    public static function ip2numeric($ip) {
        if(!$ip) return -1;
        $ips = explode('.',$ip);
        return($ips[3] | $ips[2] << 8 | $ips[1] << 16 | $ips[0] << 24);
    }

}
