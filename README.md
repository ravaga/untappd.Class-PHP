    
# Untappd.Class README

### SetUp

#### **Add your api keys to config.json**
#### **Require class**
`<?php  require("untappd.class.php); ?>`

## Get User fields USERNAME, PREFERENCE
    * info
    * whishlist
    * beers
    * badges
    * friends
    
#### **example**

` $user = Untappd::GetUser("gregavola");`
    
## Get User Friends with specific number
` $userFriends = Untappd::GetUserFriends("gregavola", 1); `
    
## Get Brewery by BREWERY_ID
` $brewery = Untappd::GetBrewery("1149");`

## Search for Brewery by Query
` $BrewerySearch = Untappd::BrewerySearch("brewery", 1);`
    
## Search for Beer by Query
` $beerSearch = Untappd::BeerSearch("lagunitas", 1);`

## Get Venue info by VENUE_ID
` $venue = Untappd::GetVenue(1222);`
