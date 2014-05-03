SteamPHP
========

A Steam API layer written in PHP

Created two versions, one to see how small I could get the application. By my understanding it is a whole lot less easier to understand the smaller you make your application(does this even make sense?).

The Steam.0 way:

$fetcher = new Steam\Fetcher;
$friendlist = $fetcher->getFriendList("A-STEAM-USERID");

The Steam.1 way:

$steam = new Steam\Steam;
$fetcher->get("friendlist", array("UserId" => "A-STEAM-USERID"), function($data){
	// Do something with $data
});


