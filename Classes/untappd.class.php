<?php
	
define("API_URL", "https://api.untappd.com/v4/");
define("CLIENT_ID", "223273EE25F5EB9DD58B228EBDF2F57036C3EAA8");
define("CLIENT_SECRET", "EB4608AA503EEA73DF9CC1CE24AD52F7A9C2586B");
define("CALLBACK_URL", "http://localhost/github/untappd_Class/callback.php");


class Untappd
{	
	public static function login()
	{
		
		$login = self::GenerateURL(["login"]);
		return $login;
	}
	
	//request token 
	public static function GetToken($var)
	{	
		
		//self::test($var);
		
		$url = self::GenerateURL(["token", $var]);
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		$token = curl_exec($curl);
		curl_close($curl);
		
		//self::test($token);
		
		// error check for token_results
		if(!$token)
			return false;
			
		//decode json result
		$result_array = json_decode($token, true);
			
		//search result for access_token
		$token_key = "access_token";
		
		$search = array_key_exists($token_key, $result_array);
				
		//yei we found it, wrap session and return
		if($search)
		{
			$access = [
			"token" => $result_array["access_token"],
			"service"=> __CLASS__
			];
			return $access;
		}
        //didnt find key on result
		if(!$search)
		{
						//go deeper
			foreach($result_array as $item)
			{
				//check each item for token key
				$search = array_key_exists($token_key, $item);
							
				if($search)
				{
								//yei we found it, wrap in session and return
					$access = [
						"token" => $item["access_token"],
						"service"=> __CLASS__
						];
					return $access;
				}
			}
		}		
	}
	
	
	/*
        *Get User Function
        * First parameter USERNAME
        * Second parameter as the search preference: 
        * - "info"
        * - "whishlist"
        * - "friends"
        * - "badges"
        * - "beers"
        * e.j  Untappd::GetUser("USERNAME", "badges");
        
    */
	public static function GetUser($param, $pref = "info", $compact = "true")
	{
		
        if(gettype($param) == "array")
        {
            $token = $param[0];
            $data = array('compact'=> $compact,'access_token'=>$token);
            $query = http_build_query($data);
            $param = "?".$query;
            
        }
        else
        {
            $data = array('compact'=>$compact,'client_id'=>CLIENT_ID,
                      'client_secret'=>CLIENT_SECRET);
        
            $query = http_build_query($data);
            $param = $param."?".$query;
            
             
        }   
        $url = API_URL."user/".$pref."/".$param;
        //make call
        $call = self::MakeCall("GET", $url);
		return $call;
		
	}
    
    /*  * Ger User's firneds with limit
        *
    */
    public static function GetUserFriends($username, $items)
	{
		
        $data = array('?limit'=>$items,
                      'client_id'=>CLIENT_ID, 
                      'client_secret'=>CLIENT_SECRET);
        
        $query = http_build_query($data);
        
        $url = API_URL."user/friends/".$username.$query;    
        //make call
		$call = self::MakeCall("GET", $url);
		return $call;
		
	}
    /*
        *Get Brewery Function
        * Unauthorized calls (default)
        * Pass brewery id as first parameter
        * e.j GetBrewery("MY_BREWERY_ID");
        
    */
    
    // ref.  GetBrewery("1149");
    public static function GetBrewery($brewery_id, $compact = "true")
    {
		
        $data = array('compact'=>$compact,
                      'client_id'=>CLIENT_ID,
                      'client_secret'=>CLIENT_SECRET);
        
        $query = http_build_query($data);
        
        $url = API_URL."brewery/info/".$brewery_id."?".$query;
		
        //make call
		$call = self::MakeCall("GET", $url);
		
		return $call;
		
	}
	
    /*
        * BrewerySearch function
        * Pass Query as argument
        * e.j BrewerySearch("Stone brewery");
    */
    public static function BrewerySearch($search, $limit = 10, $offset = 0)
    {
		$data = array('q'=>$search,
                      'limit'=>$limit,
                      'offset'=>$offset,
                      'client_id'=>CLIENT_ID,
                      'client_secret'=>CLIENT_SECRET);
        
        $query = http_build_query($data);
        $url = API_URL."search/brewery?".$query;
        
        //make call
		$brewery = self::MakeCall("GET", $url);
		
		return $brewery;
		
	}
    /*
        * BeerSearch function
        * Pass Query as argument
        * e.j BeerSearch("Stone brewery");
    */
    public static function BeerSearch($search, $limit = 10, $sort = "count" , $offset = 0)
    {
		
        $data = array('q'=>$search,
                      'offset'=>$offset, 
                      'limit'=>$limit,
                      'sort'=>$sort,
                      'client_id'=> CLIENT_ID,
                      'client_secret'=> CLIENT_SECRET);
        
        $query = http_build_query($data);
        
        $url = API_URL."search/beer?".$query;
        
        //make call
		$beer = self::MakeCall("GET", $url);
		
		return $beer;
		
	}
    
    public static function GetVenue($id, $compact = "true")
    {
        $pref = "info";
        if(gettype($id) == "array")
        {
            $vID = $id[0];
            $pref = $id[1];
        }
        else
        {
            $vID = $id;
        }
        
        $data = array('compact'=>$compact,
                      'client_id'=>CLIENT_ID,
                      'client_secret'=>CLIENT_SECRET);
        
        $query = http_build_query($data);
        
        $url = API_URL."brewery/".$pref."/".$vID."?".$query;
        
        $venue = self::MakeCall("GET", $url);
        
        return $venue;
        
    }
    
    
    //Get Calls -> MakeCall("GET", $url);
    //Post Calls -> MakeCall("POST", $url, [$values]);
    public static function MakeCall($method = "GET", $url)
    {
        if($method == "GET")
        {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            $curl_result = curl_exec($curl);
            curl_close($curl);
        }
        else if($method == "POST")
        {
            //Make Call 
        }
        
        $array = json_decode($curl_result, true);
        $response = $array["response"];
        
        
        return $response;
        
        
    }

	public static function GenerateURL($var = [])
	{
		
		$req = $var[0];
		
		//login url
		if($req == "login")
		{
			$url =  "https://untappd.com/oauth/authenticate/".
					"?client_id=".CLIENT_ID.
					"&response_type=code".
					"&redirect_url=".CALLBACK_URL;
						
			
			$group = [
				"name"=> __CLASS__,
				"url"=> $url
			];
		//clean for return
		$login = $group;
		
		return $login;
		
		}
		//token url 
		else if($req == "token" && !empty($var[1]))
		{
			$code = $var[1];
			$url = "https://untappd.com/oauth/authorize/".
				   "?client_id=".CLIENT_ID.
				   "&client_secret=".CLIENT_SECRET.
				   "&response_type=code".
				   "&redirect_url=".CALLBACK_URL.
				   "&code=".$code;
			return $url;
		}
	}

    
    public static function test($var , $foo)
    {
        echo("<pre><b>".$var."</b><br/>");
        print_r($foo);
        echo("</pre>");
    }
    
}	
	
	
	
?>