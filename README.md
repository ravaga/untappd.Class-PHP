    
# Get User fields USERNAME, PREFERENCE
    * info
    * whishlist
    * beers
    * badges
    * friends
    
#### **example**

`<addr>` $user = Untappd::GetUser("gregavola");
`<addr>`Untappd::test("Get User", $user);
    
# Get User Friends with specific number
`<addr>` $userFriends = Untappd::GetUserFriends("gregavola", 1);
`<addr>` Untappd::test("Get User Friends Limit 1", $userFriends);
    
# Get Brewery by BREWERY_ID
`<addr>` $brewery = Untappd::GetBrewery("1149");
`<addr>` Untappd::test("Get Brewery",$brewery);

# Search for Brewery by Query
`<addr>` $BrewerySearch = Untappd::BrewerySearch("brewery", 1);
`<addr>` Untappd::test("Brewery Search Limit 1", $BrewerySearch);
    
# Search for Beer by Query
`<addr>` $beerSearch = Untappd::BeerSearch("lagunitas", 1);
`<addr>` Untappd::test("Beer Search Limit 1", $beerSearch);

# Get Venue info by VENUE_ID
`<addr>` $venue = Untappd::GetVenue(1222);
`<addr>` Untappd::test("Get Venue",$venue);
