    
# Untappd.Class README

### SetUp
`<?php require("untappd.class.php);?>

### Get User fields USERNAME, PREFERENCE
    * info
    * whishlist
    * beers
    * badges
    * friends
    
#### **example**

` $user = Untappd::GetUser("gregavola");`
` Untappd::test("Get User", $user);`
    
### Get User Friends with specific number
` $userFriends = Untappd::GetUserFriends("gregavola", 1); `
` Untappd::test("Get User Friends Limit 1", $userFriends); `
    
## Get Brewery by BREWERY_ID
` $brewery = Untappd::GetBrewery("1149");`
` Untappd::test("Get Brewery",$brewery);`

## Search for Brewery by Query
` $BrewerySearch = Untappd::BrewerySearch("brewery", 1);`
` Untappd::test("Brewery Search Limit 1", $BrewerySearch);`
    
## Search for Beer by Query
` $beerSearch = Untappd::BeerSearch("lagunitas", 1);`
` Untappd::test("Beer Search Limit 1", $beerSearch);`

## Get Venue info by VENUE_ID
` $venue = Untappd::GetVenue(1222);`
` Untappd::test("Get Venue",$venue);`
