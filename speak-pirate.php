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
        add_shortcode('speak_pirate', array($this, 'speak_pirate_shortcode'), 10, 2);
    }

    function speak_pirate( $content = null ){
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

    function speak_pirate_shortcode( $args, $content = null ) {
      return $this->speak_pirate( $content );
    }

    /**
     * Add filter to all content on Speak like a Pirate Day (Sept. 19)
     */
     if ( 'Sep 19' === date('M j') )  {
       add_filter( 'the_content', array($this, 'speak_pirate') );
     }
}

// Create an instance of the class so it will run
$speak_pirate = new Speak_Pirate();
?>
