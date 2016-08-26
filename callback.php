<?php
    require("Classes/untappd_Class.php");

    if($_SERVER["REQUEST_METHOD"] == 'GET')
    {
        $accessToken = Untappd::GetToken($_GET["code"]);
        
        if($accessToken)
        {
            $token = $accessToken["token"];
            
            //Get User
            Untappd::test("Client Access Token",$accessToken);
            $user = Untappd::GetUser([$token]);    
            
            Untappd::test("Client Auth User", $user);
        }
    }

?>