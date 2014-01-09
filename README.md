# Theme Changer Module

## Introduction

	Provides a way to change themes using a query string parameter and cookies.  It has been designed specifically for graphic artists developing and testing themes without a development environment.  When the theme is not the configured theme, the template cache is flushed. 

## To do
	* Make cache flushing configurable

## Maintainer Contact

 * Miles Summers
   <miles (at) youngearth (dot) com (dot) au>

## Requirements

 * SilverStripe 3.1 or newer

## Installation

 * Copy the `themechanger` directory into your main SilverStripe webroot
 * Run ?flush=1


## Usage
	To change themes go to <Your website URL>?theme=<theme_name>
	
	Variables that can be set in your mysite/_config.php
	
	ThemeChangerControllerExtension::$flush_cache = true or false; // whether to flush the cache for non-configured themes
	ThemeChangerControllerExtension::$cookie_expire_time = 1;	// set the cookie expire time in days

## Known issues:
	None
