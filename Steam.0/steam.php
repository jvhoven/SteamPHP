<?php
	
	namespace Steam;

	abstract class Steam{

		/*
		* Your own personal steam dev id.
		*/
		CONST API_KEY = "YOUR_API_KEY";

		/*
		* The urls required for fetching certain information
		* from the Steam API
		*/
		public $urls = [
			"getUser" => "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key={API_KEY}&steamids={ISteamUser}",
			"getAppNews" => "http://api.steampowered.com/ISteamNews/GetNewsForApp/v0002/?appid={AppId}&count=3&maxlength=300&format=json",
			"getGlobalAchievementPercentagesForApp" => "http://api.steampowered.com/ISteamUserStats/GetGlobalAchievementPercentagesForApp/v0002/?gameid={GameId}&format=json",
			"getFriendList" => "http://api.steampowered.com/ISteamUser/GetFriendList/v0001/?key={API_KEY}&steamid={ISteamUser}&relationship=friend",
			"getPlayerAchievements" => "http://api.steampowered.com/ISteamUserStats/GetPlayerAchievements/v0001/?appid={AppId}&key={API_KEY}&steamid={ISteamUser}",
			"getOwnedGames" => "http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key={API_KEY}&steamid={ISteamUser}&format=json",
			"getRecentGames" => "http://api.steampowered.com/IPlayerService/GetRecentlyPlayedGames/v0001/?key={API_KEY}&steamid={ISteamUser}&format=json"
		];

		/*
		* The default get functions
		*/
		abstract public function getUser($ISteamUser);
		abstract public function getAppNews($AppId);
		abstract public function getGlobalAchievementPercentagesForApp($GameId);
		abstract public function getFriendList($ISteamUser);
		abstract public function getPlayerAchievements($ISteamUser, $AppId);
		abstract public function getOwnedGames($ISteamUser);
		abstract public function getRecentGames($ISteamUser);

		/*
		* Data retrieval functions that communicate with the Steam API 
		*/
		abstract protected function fetchUser($ISteamUser);
		abstract protected function fetchAppNews($AppId);
		abstract protected function fetchGlobalAchievementPercentagesForApp($GameId);
		abstract protected function fetchFriendList($ISteamUser);
		abstract protected function fetchPlayerAchievements($ISteamUser, $AppId);
		abstract protected function fetchOwnedGames($ISteamUser);
		abstract protected function fetchRecentGames($ISteamUser);

		/*
		* Format the url to fit the needs of the Steam API
		*/
		public function formatUrl(){
			
			$args = func_get_args();
			$url = $args[0]["URL"];

			foreach($args[0]["REPLACE"] as $key => $value){
				$url = str_replace("{" . $key . "}", $value, $url);
			}

			return $url;
		}

	}