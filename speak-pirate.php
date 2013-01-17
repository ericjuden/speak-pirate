<?php
/**
 * Plugin Name: Speak Pirate
 * Plugin URI: 
 * Description: translates text in a shortcode into the equivalent text spoken as a pirate
 * Author: ericjuden
 * Author URI: http://ericjuden.com
 * Version: 1.0
 */
 
class Speak_Pirate {
    function __construct(){
        // Constructor...actions and filters go here
        add_shortcode('speak_pirate', array($this, 'speak_pirate'), 10, 2);
    }
 
    function speak_pirate($args, $content = null){
    	// Check if there is any content
    	if($content == null){
    		return;
    	}
    	
    	// URL encode our "pirate" text
    	$text = urlencode($content);
    	
    	// Set the url for our web service. Found API from apihub.com
    	$url = sprintf('http://isithackday.com/arrpi.php?text=%s', $text);
        
    	// Retrieve response from web service
    	$response = wp_remote_get($url);
        
    	// Return translated string. If nothing found, returns empty string
        return wp_remote_retrieve_body($response);
    }
}
 
// Create an instance of the class so it will run
$speak_pirate = new Speak_Pirate();
?>