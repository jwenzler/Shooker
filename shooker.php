<?php
	
	//Slack webhooks made incredibly easy
	class Shooker {
		
		//No error by default
		private $error = false;
		private $errorMessages = array();
		
		//Token to make sure the request is coming from Slack
		private $token = null;
		
		//Text to send back to Slack client
		private $responseText = null;
		
		//Trigger array
		private $triggers;
		
	    function __constructNoToken() {
	    	$this->triggers = new stdClass;
	    } 
		
	    function __construct($token) { 
	    	$this->triggers = new stdClass;
	    	$this->token = $token;
	    } 
		
		function setToken($token) {
			$this->token = $token;
		}
		
		function addTrigger($triggerWord) {
			$trigger = new ShookerTrigger($triggerWord);
			$this->triggers->{$triggerWord} = $trigger;
			return $trigger;
		}
		
		//Calculate response text and send it back to the Slack client
		function listen() {
			
			//Retrieve the text inbound to the webhook
			$inText = $_POST['text'];
			//Retrieve the user name for the sent in message
			$inUser = $_POST['user_name'];
			//Retrieve the channel name message was sent in
			$inChannel = $_POST['channel_name'];
			
			//Get the first word sent in (should match trigger)
			$firstWord = explode(" ",$inText);
			$firstWord = $firstWord[0];
			
			$inText = substr($inText, strlen($firstWord)+1);
	
			if (isset($this->triggers->{$firstWord})) {
				
				//Retrieve the trigger
				$trigger = $this->triggers->{$firstWord};
				
				//Make sure there is an attached action to the trigger word
				if (sizeof($trigger->actions) > 0) {
				
					//Loop through and complete any actions attached to trigger
					foreach ($trigger->actions as $action) {
				
						//Check for token, this is a requirement for security reasons
						if (isset($this->token)) {
							//Make sure we have a POSTed token and that the token matches the token we have supplied
							if (isset($_POST['token']) && $_POST['token'] == $this->token) {
								
								$this->responseText = $action($inText, $inUser, $inChannel);
								
							} else {
								$this->error = true;
								array_push($this->errorMessages, "Mismatched tokens, please make sure the token you supplied matches the one setup with Slack webhook");
							}
							
						} else {
							$this->error = true;
							array_push($this->errorMessages, "Please set a token with the constructor or using setToken function");
						}
					
					}	
					
				} else {
					$this->error = true;
					array_push($this->errorMessages, "No action provided for the given trigger word: ".$firstWord);
				}
					
				$ret = new stdClass;
					
				//If we are free from errors, return the response text we calculated
				if (!$this->error) {
					//Create a return for the Slack client
					$ret->text = $this->responseText;
				
				//Otherwise we have an error, return all applicable messages
				} else {
					//Add error info
					$ret->text = "`Error(s): ".implode(", ",$this->errorMessages)."`";
				}
				
				//Convert to a JSON string
				$ret = json_encode($ret);
				
				echo $ret;
				
			}
		}
	}
	
	
	//class Trigger class
	class ShookerTrigger {
		
		private $triggerWord;
		public $actions = array();
		
		//Create a trigger with given triggerword
	    function __construct($triggerWord) { 
	    	$this->triggerWord = $triggerWord;
	    } 
		
		function addAction($fxn) {
			array_push($this->actions, $fxn);
		}
	}
	
?>