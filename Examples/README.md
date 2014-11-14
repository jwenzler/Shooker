<h1>Examples using Shooker</h1>
<h3><a href="https://github.com/jwenzler/Shooker"/>Get Shooker HERE</a></h3>

<h2>Slack & OpenWeatherMap API</h2>
![alt example](http://i.imgur.com/SAblq68.png)
```php
  	$testTrigger = $shkr->addTrigger("weather");
	$testTrigger->addAction(function($paramString, $user, $channel){
		$json = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q='.$paramString);
		$obj = json_decode($json);
		$curTemp = ktotemps($obj->main->temp);
		return "Currently *".round($curTemp->fahrenheit)."°F (".round($curTemp->celsius)."°C)* and *".$obj->weather[0]->description."*.";
	});
```
<h2>Slack & Leetify</h2>
![alt example](http://i.imgur.com/OLKQoGE.png)
```php
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
```
