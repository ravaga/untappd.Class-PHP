    
# Untappd.Class README

### SetUp

#### **Add your api keys to config.json**
#### **Require class**
`<?php  require("untappd.class.php); ?>`

## Get User fields USERNAME, PREFERENCE
    info
    whishlist
    beers
    badges
    friends

#### Simple Get User info
` $user = Untappd::GetUser("ravaga");`
#### Get User's friends
` $user = Untappd::GetUser("ravaga", "friends"); `    
    
## Get Specific number of Friends from User 
` $userFriends = Untappd::GetUserFriends("gregavola", 1); `
    
## Get Brewery by BREWERY_ID
` $brewery = Untappd::GetBrewery("1149");`

## Search for Brewery
` $BrewerySearch = Untappd::BrewerySearch("Stone brewery");`
    
## Search for Beer  
` $beerSearch = Untappd::BeerSearch("lagunitas", 1);`

## Get Venue info by VENUE_ID
` $venue = Untappd::GetVenue(1222);`
