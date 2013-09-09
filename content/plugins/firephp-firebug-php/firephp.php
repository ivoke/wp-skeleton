<?php
/*
Plugin Name: FirePHP / Firebug PHP Integration
Plugin URI: http://asketic.lv
Description: Adds FirePHP Integration, php function fb(...) etc. More information <a href="http://www.firephp.org" target="_blank">http://www.firephp.org</a>
Author: Evalds Urtans
Version: 1.0.0
Author URI: http://www.asketic.lv
*/

//Firebug
if(!function_exists('fb'))
{
	require_once(dirname(__FILE__) . '/vendor/fb.php');
}

class HandlerFirePHP {
	
	public function __construct()
    {    	
		add_action('init', array( $this, 'onInit' ), 0 );		
		add_action('wp_footer', array( $this, 'onFooter' ), 100 );
		add_action('admin_footer', array( $this, 'onFooter' ), 100 );	 						  
    }
	
	public function onInit() 
	{
		ob_start();
	}
	
	public function onFooter() 
	{
		ob_flush();
	}
}
$handlerFirePHP = new HandlerFirePHP();