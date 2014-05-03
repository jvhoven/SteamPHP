<?php
	
	namespace Steam;

	use \Steam\Curl\Curl as Curl;
	use \Steam\Handler as Handler;

	class Fetcher extends \Steam\Steam{

		/*
		* Get user information specified 
		* by user id
		*
		* @var int ISteamUser 
		*	The users steamID
		*/
		public function getUser($ISteamUser)
		{
			return $this->fetchUser($ISteamUser);
		}

		/*
		* Gets news/updates from application specified 
		* by application id
		*
		* @var string AppId 
		*	The applications steamID
		*/
		public function getAppNews($AppId)
		{
			return $this->fetchAppNews($AppId);
		}

		/*
		* Gets the global percentage of achievements 
		* for specified game
		*
		* @var int GameId 
		*	The games steamId
		*/
		public function getGlobalAchievementPercentagesForApp($GameId)
		{
			return $this->fetchGlobalAchievementPercentagesForApp($GameId);
		}

		/*
		* Get friend list from user specified 
		* by user id
		*
		* @var int ISteamUser 
		*	The users steamID
		*/
		public function getFriendList($ISteamUser)
		{
			return $this->fetchFriendList($ISteamUser);
		}

		/*
		* Get players achievements by application.
		*
		* @var int ISteamUser 
		*	The users steamID
		*
		* @var int AppId
		* The application steamID
		*/
		public function getPlayerAchievements($ISteamUser, $AppId)
		{
			return $this->fetchPlayerAchievements($ISteamUser, $AppId);
		}

		/*
		* Get owned games for user.
		*
		* @var int ISteamUser 
		*	The users steamID
		*/
		public function getOwnedGames($ISteamUser)
		{
			return $this->fetchOwnedGames($ISteamUser);
		}

		/*
		* Get recently played games by user.
		*
		* @var int ISteamUser 
		*	The users steamID
		*/
		public function getRecentGames($ISteamUser)
		{
			return $this->fetchRecentGames($ISteamUser);
		}

		/*
		* Fetches the user information from the
		* steam API.
		*
		* @var int ISteamUser
		*	The users steamID
		*/
		protected function fetchUser($ISteamUser)
		{
			$data = [
				"REPLACE" => [
					"API_KEY" => STATIC::API_KEY,
					"ISteamUser" => $ISteamUser
				],
				"URL" => $this->urls["FETCH_USER"]
			];

			$url = $this->formatUrl($data);
			$curl = new Curl($url);

			return $curl->exec()->response->players[0];
		}

		/*
		* Fetches the application news/updates from the
		* steam API.
		*
		* @var string AppId
		*	The applications steamID
		*/
		protected function fetchAppNews($AppId)
		{
			$data = [
				"REPLACE" => [
					"AppId" => $AppId
				],
				"URL" => $this->urls["APP_NEWS"]
			];

			$url = $this->formatUrl($data);
			$curl = new Curl($url);

			return $curl->exec()->appnews->newsitems;
		}

		/*
		* Fetches the friend list from the
		* steam API of the specified user.
		*
		* @var string AppId
		*	The applications steamID
		*/
		protected function fetchFriendList($ISteamUser)
		{
			$data = [
				"REPLACE" => [
					"ISteamUser" => $ISteamUser,
					"API_KEY" => STATIC::API_KEY
				],
				"URL" => $this->urls["FRIEND_LIST"]
			];

			$url = $this->formatUrl($data);
			$curl = new Curl($url);

			return $curl->exec()->friendslist->friends;
		}

		/*
		* Fetches the global achievement percentage for specified
		* game from the steam API.
		*
		* @var string GameId
		*	The games steamID
		*/
		protected function fetchGlobalAchievementPercentagesForApp($GameId)
		{
			$data = [
				"REPLACE" => [
					"GameId" => $GameId
				],
				"URL" => $this->urls["GLOBAL_ACHIEV"]
			];

			$url = $this->formatUrl($data);
			$curl = new Curl($url);

			return $curl->exec()->achievementpercentages->achievements;
		}

		/*
		* Fetches the achievements of the specified user
		* from the steam API by application.
		*
		* @var string ISteamUser
		*	The users steamID
		*
		* @var string AppId
		*	The application steamID
		*/
		protected function fetchPlayerAchievements($ISteamUser, $AppId)
		{
			$data = [
				"REPLACE" => [
					"ISteamUser" => $ISteamUser,
					"AppId" => $AppId,
					"API_KEY" => STATIC::API_KEY
				],
				"URL" => $this->urls["PLAYER_ACHIEV"]
			];

			$url = $this->formatUrl($data);
			$curl = new Curl($url);

			return $curl->exec()->playerstats->achievements;
		}

		/*
		* Fetches the owned games of the specified user
		* from the steam API.
		*
		* @var string ISteamUser
		*	The users steamID
		*/
		protected function fetchOwnedGames($ISteamUser)
		{
			$data = [
				"REPLACE" => [
					"ISteamUser" => $ISteamUser,
					"API_KEY" => STATIC::API_KEY
				],
				"URL" => $this->urls["OWNED_GAMES"]
			];

			$url = $this->formatUrl($data);
			$curl = new Curl($url);

			return $curl->exec()->response->games;
		}

		/*
		* Fetches the recent played games for specified user
		* from the steam API.
		*
		* @var string ISteamUser
		*	The users steamID
		*/
		protected function fetchRecentGames($ISteamUser)
		{
			$data = [
				"REPLACE" => [
					"ISteamUser" => $ISteamUser,
					"API_KEY" => STATIC::API_KEY
				],
				"URL" => $this->urls["RECENT_GAMES"]
			];

			$url = $this->formatUrl($data);
			$curl = new Curl($url);

			return $curl->exec()->response->games;
		}




	}