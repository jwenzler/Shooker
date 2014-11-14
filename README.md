<h1>Shooker - Slack WebHooks made crazy simple</h1>

<h2>Example for the TLDR crowd</h2>

<h3>Setup on Slack</h3>
Navigate to <a href="https://eacllc.slack.com/services/new">https://eacllc.slack.com/services/new</a> and choose to add a new outgoing WebHook.  

For this page note the following fields:

Channel: You can use any or select a specific channel.  The benefit of choosing a channel is that you will not have to specify trigger words in the next field.

Trigger Word(s): If you chose a specific channel, you can skip this setup, otherwise place all words you plan on using for triggers in this field with commas separating them.

URL(s): Place the location of the PHP file you are going to include Shooker on here.

Token: Note this value because you will need to add it within the class initialization.

Descriptive Label: Optional and only used to provide context within Slack integrations list.

Customize Name: Use whatever name you want to display within the Slack client along with your responses from PHP.

Customize Icon: Again, whatever you want here.

<h3>Setup within PHP</h3>

<p>Just include the main class file and then set up Shooker like so:</p>
<code>
//Initialize class with the token from Slack
$shkr = new Shooker('Q7TWi2PP7hHksj7o5aGnZ9QA');
//Add a trigger based on keyword "test"
$testTrigger = $shkr->addTrigger("test");
//When this trigger is hit, perform this function
$testTrigger->addAction(function($paramString, $user, $channel){
    return "params: ".$paramString." user: ".$user." channel: ".$channel;
});
//This function is required to listen for triggers within Slack client, make sure to call after all triggers are added
$shkr->listen();
</code>

<h2>THAT'S IT!</h2> 