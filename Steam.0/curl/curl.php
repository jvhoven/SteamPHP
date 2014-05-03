<?php
	
	namespace Steam\Curl;	

	class Curl{

		/*
		* The CURL connection. 
		*/
		protected $conn;

		/*
		* The result of the call.
		*/
		protected $res;

		/*
		* Sets up a new CURL connection.
		*
		* @var string url
		*	The url to fetch from
		*/
		public function __construct($url)
		{
			$this->conn = curl_init($url);
			curl_setopt($this->conn, CURLOPT_RETURNTRANSFER, 1);
		}

		/*
		* Returns the result of the call.
		*/
		public function exec(){
			$this->res = json_decode(curl_exec($this->conn));
			return $this->res;
		}

	}