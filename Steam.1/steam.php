<?php
	
	namespace Steam;

	use \Steam\Curl\Curl as Curl;

	class Steam{

		/*
		* Your own personal steam dev id.
		*/
		CONST API_KEY = "YOUR_API_KEY";

		/*
		* The urls required for fetching certain information
		* from the Steam API
		*/
		public $urls = [
			"user" => "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key={API_KEY}&steamids={UserId}",
			"appnews" => "http://api.steampowered.com/ISteamNews/GetNewsForApp/v0002/?appid={AppId}&count=3&maxlength=300&format=json",
			"globalachiev" => "http://api.steampowered.com/ISteamUserStats/GetGlobalAchievementPercentagesForApp/v0002/?gameid={GameId}&format=json",
			"friendlist" => "http://api.steampowered.com/ISteamUser/GetFriendList/v0001/?key={API_KEY}&steamid={UserId}&relationship=friend",
			"playerachiev" => "http://api.steampowered.com/ISteamUserStats/GetPlayerAchievements/v0001/?appid={AppId}&key={API_KEY}&steamid={UserId}",
			"ownedgames" => "http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key={API_KEY}&steamid={UserId}&format=json",
			"recentgames" => "http://api.steampowered.com/IPlayerService/GetRecentlyPlayedGames/v0001/?key={API_KEY}&steamid={UserId}&format=json"
		];

		/*
		* Retrieves the data from the API.
		* The result will be passed to the closure 
		* embedded with the call.
		*
		* @var string method
		*	The method to call as in seen in the urls array
		* 
		* @var array identifier
		*	The variables needed by the url to retrieve the results
		*
		* @var closure closure
		*	The callback function in which the data will reside.
		*/
		public function get($method, $identifier, $closure = false)
		{
			$url = $this->formatUrl(array($method, $identifier));
			$curl = new Curl($url);

			$result = $curl->exec();
			if(!is_callable($closure)){
				return $result;
			}

			call_user_func_array($closure, (array)$result); 
		}


		/*
		* Format the url to fit the needs of the Steam API
		*
		* This will for example replace all curly bracket values with 
		* arguments given to the appriopriate function.
		*/
		public function formatUrl(){
			
			$args = func_get_args();

			$url = $this->urls[$args[0][0]];
			preg_match_all('/{([^{|}]*)}/', $url, $matches);
			$i = 0;

			foreach($matches[1] as $match){
				
				// If we're looking to replace a constant.
				if(strtoupper($match) == $match){
					$class = new \ReflectionClass(__CLASS__);
					$value = $class->getConstant($match);
				} else {
					$value = $args[0][1][$match];
				}

				$url = str_replace($matches[0][$i], $value, $url);
				$i++;
			}

			return $url;
		}

	}