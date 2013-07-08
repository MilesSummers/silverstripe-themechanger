<?php
/**
 * Extension to {@link ContentController} which handles
 * testing of themes by passing theme request variable
 * 
 * @package themechanger
 */
class ThemeChangerControllerExtension extends Extension {

	/**
	 * The expiration time of a cookie set for theme change in days.
	 * Default is 0, to expire with session.
	 * @var int
	 */
	public static $cookie_expire_time = 0;
	
	/**
	 * Whether to flush the cache for non-configured themes.  
	 * Default is true.
	 * @var boolean
	 */
	 public static $flush_cache = true;

	/**
	 * Override the default behavior to ensure that if a theme has been specified to serve the correct theme
	 */
	public function onAfterInit() {
		global $_TEMPLATE_MANIFEST;
		
		$config = SiteConfig::current_site_config();
		$request = $this->owner->getRequest();

		// Redirect users to the full site if requested (cookie expires in 30 minutes)
		$new_theme = $request->getVar('theme');
		if(isset($new_theme)) {
			// check that it is a valid theme
			if(isset($_TEMPLATE_MANIFEST['Page']['themes'][$new_theme])) {
				Cookie::set('theme', $new_theme, self::$cookie_expire_time);
				if($new_theme != $config->Theme) Director::set_environment_type("dev");
				SSViewer::set_theme($new_theme);
			}
		} elseif(Cookie::get('theme')) {
			if(Cookie::get('theme') != $config->Theme) Director::set_environment_type("dev");
			SSViewer::set_theme(Cookie::get('theme'));			
		} else {
			Director::set_environment_type("live");
			SSViewer::set_theme($config->Theme);
		}
		
		// if I am testing a theme then flush the cache
		if (self::$flush_cache && Director::isDev()) {
			SSViewer::flush_template_cache();
		}
	}
}
