<h1>Shooker - Slack WebHooks made crazy simple</h1>

<h2>Tutorial and Source Explanation</h2>
<a href="http://devopsr.com/simple-slack-webhooks-in-php/">http://devopsr.com/simple-slack-webhooks-in-php/</a>

<h2>Examples</h2>
<a href="http://devopsr.com/connecting-slack-to-an-api-speak-like-yoda-you-will/">Yoda Translator</a><br/>
<a href="https://github.com/jwenzler/Shooker/tree/master/Examples">More examples here with source code &raquo;</a>

<h1>Incoming & Outgoing Webhooks are now supporte!</h1>

<h3>Setup on Slack</h3>

<h4>Incoming<h4>

Navigate to https://TEAMNAME.slack.com/services/new</a> and choose to add a new incoming WebHook.  

You only really need the `Webhook URL` but feel free to adjust the default username and image.


<h4>Outgoing</h4>

![alt example](http://i.imgur.com/L1LKPzQ.png)

Navigate to https://TEAMNAME.slack.com/services/new</a> and choose to add a new outgoing WebHook.  

For this page note the following fields:

<ul>
<li><b>Channel</b>: You can use any or select a specific channel.  The benefit of choosing a channel is that you will not have to specify trigger words in the next field.</li>
<li><b>Trigger Word(s)</b>: If you chose a specific channel, you can skip this setup, otherwise place all words you plan on using for triggers in this field with commas separating them.</li>
<li><b>URL(s)</b>: Place the location of the PHP file you are going to include Shooker on here.</li>
<li><b>Token</b>: Note this value because you will need to add it within the class initialization.</li>
<li><b>Descriptive Label</b>: Optional and only used to provide context within Slack integrations list.</li>
<li><b>Customize Name</b>: Use whatever name you want to display within the Slack client along with your responses from PHP.</li>
<li><b>Customize Icon</b>: Again, whatever you want here.</li>
</ul>

<h3>Setup within PHP</h3>

<p>Just include the main class file and then set up Shooker like so:</p>

<h4>Incoming</h4>
```php
//Initialize class with the token from Slack
$shkr = new Shooker();

$shkr->setupIncoming('<YOUR WEBHOOK URL HERE>');

//Send a message (message, username, emoji)
$shkr->sendMessage("Your message here", "Mr. Bot", ":ballot_box_with_check:"); 
```

<h4>Outgoing</h4>
```php
//Initialize class with the token from Slack
$shkr = new Shooker();

$shkr->setupOutgoing('<YOUR TOKEN HERE>');

//Add a trigger based on keyword "test"
$testTrigger = $shkr->addTrigger("test");

//When this trigger is hit, perform this function
$testTrigger->addAction(function($paramString, $user, $channel){
return "params: ".$paramString." user: ".$user." channel: ".$channel;
});

//This function is required to listen for triggers within Slack client, make sure to call after all triggers are added
$shkr->listen();
```

<h2>THAT'S IT!</h2> 
