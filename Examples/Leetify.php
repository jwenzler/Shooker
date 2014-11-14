<?php
	/*------------------------------------------------------------------------
	 *  OpenWeatherMapAPI.php
	 *     Simple example showing how to hook into open weather API
	 * 
	 *  Created by: John Wenzler (nnullandvoidd@gmail.com)
	 *  Available under the MIT License
	 *  FOR MORE INFO AND EXAMPLES, VISIT:
	 *     https://github.com/jwenzler/Shooker
	 * 
	 ------------------------------------------------------------------------*/
	 
	//Leetify attributed to RobertPitt from StackOverflow
	//post on http://stackoverflow.com/questions/4114651/string-to-leet-1337-speak-in-php
	
	class Leetify {
	    private $english = array("a", "e", "s", "S", "A", "o", "O", "t", "l", "ph", "y", "H", "W", "M", "D", "V", "x"); 
	    private $leet = array("4", "3", "z", "Z", "4", "0", "0", "+", "1", "f", "j", "|-|", "\\/\\/", "|\\/|", "|)", "\\/", "><");
	   	   
	   function encode($string) {
	        $result = '';
	        for ($i = 0; $i < strlen($string); $i++) {
	            $char = $string[$i];
	            if (false !== ($pos = array_search($char, $this->english))) 
	            {
	                $char = $this->leet[$pos]; //Change the char to l33t.
	            }
	            $result .= $char;
	        }
	        return $result; 
	    }
	}
	
	$testTrigger = $shkr->addTrigger("1337");
	$testTrigger->addAction(function($paramString, $user, $channel){
		$leetify = new Leetify();
		return $leetify->encode($paramString);
	});
?>