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
	 
	$testTrigger = $shkr->addTrigger("weather");
	$testTrigger->addAction(function($paramString, $user, $channel){
		$json = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q='.$paramString);
		$obj = json_decode($json);
		$curTemp = ktotemps($obj->main->temp);
		return "Currently *".round($curTemp->fahrenheit)."°F (".round($curTemp->celsius)."°C)* and *".$obj->weather[0]->description."*.";
	});

?>