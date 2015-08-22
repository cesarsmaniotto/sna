<?php

namespace comunic\social_network_analyzer\model\repository\arango{

	require "vendor/autoload.php";

	use triagens\ArangoDb\Connection;
	use triagens\ArangoDb\ConnectionOptions;
	use triagens\ArangoDb\UpdatePolicy;

	class ConnectionArango{

		private $connection;

		function __construct(){

			$connectionOptions =array(
			    // server endpoint to connect to
				ConnectionOptions::OPTION_ENDPOINT => 'tcp://127.0.0.1:8529',
			    // authorization type to use (currently supported: 'Basic')
				ConnectionOptions::OPTION_AUTH_TYPE => 'Basic',
			    // user for basic authorization
				ConnectionOptions::OPTION_AUTH_USER => 'root',
			    // password for basic authorization
				ConnectionOptions::OPTION_AUTH_PASSWD => '',
			    // connection persistence on server. can use either 'Close' (one-time connections) or 'Keep-Alive' (re-used connections)
				ConnectionOptions::OPTION_CONNECTION => 'Close',
			    // connect timeout in seconds
				ConnectionOptions::OPTION_TIMEOUT => 30,
			    // whether or not to reconnect when a keep-alive connection has timed out on server
				ConnectionOptions::OPTION_RECONNECT => true,
			    // optionally create new collections when inserting documents
				ConnectionOptions::OPTION_CREATE => true,
			    // optionally create new collections when inserting documents
				ConnectionOptions::OPTION_UPDATE_POLICY => UpdatePolicy::LAST,
				ConnectionOptions::OPTION_DATABASE           => 'sna'
				);

$this->connection = new Connection($connectionOptions);

}

public function getConnection(){
	return $this->connection;
}


}

}


?>