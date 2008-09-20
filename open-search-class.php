<?php
/**
 * This class provides Open search plugin's main functionalities.
 * 
 * @author Darathor < darathor@free.fr >
 * @package open-search
 */
class OpenSearch
{
	/**
	 * @return String
	 */
	public static function getPostSearchTile()
	{
		return get_bloginfo('name', 'display') . ' : ' . __('Search in posts', 'open-search');
	}
	
	/**
	 * @return void
	 */
	public static function completeHeader()
	{
		$url = get_bloginfo('home', 'display') . '/wp-content/plugins/open-search/open-search-xml.php';
		$title = self::getPostSearchTile();
		echo("\n\n	<link rel=\"search\" type=\"application/opensearchdescription+xml\" href=\"$url\" title=\"$title\" />\n\n");
	}
	
	/**
	 * @return void
	 */
	private static function initialize()
	{
		// Include the locales.
		load_plugin_textdomain('open-search', 'wp-content/plugins/open-search/languages');
	}
	
	/**
	 * Echo the XML definition.
	 * Called in open-search-xml.php.
	 * @return void
	 */
	public static function echoXml()
	{
		self::initialize();

		$xmlHeader = '<?xml version="1.0" encoding="' . get_bloginfo('charset', 'display') . '" ?>' . "\n";
		$encodedIcon = self::getEncodedIcon();
		$searchUrl = get_bloginfo('home', 'display') . '/?s={searchTerms}';
		
		if (file_exists(TEMPLATEPATH . '/open-search-xml.php'))
		{
			$templatePath = TEMPLATEPATH . '/open-search-xml.php';
		}
		else
		{
			$templatePath = 'templates/open-search-xml.php';
		}
		require_once($templatePath);
	}	
	
	/**
	 * @return void
	 */
	public static function setUpInFrontoffice()
	{
		self::initialize();
		
		// Add link in the head section.
		add_action('wp_head', array('OpenSearch', 'completeHeader'));
	}
	
	/**
	 * Get encoded icon (in base 64).
	 * @return String
	 */
	private static function getEncodedIcon()
	{
		// Get the icon path.
		$iconPathAndBaseNames = array();
		$iconPathAndBaseNames[] = TEMPLATEPATH . '/favicon.';
		$iconPathAndBaseNames[] = '../../../favicon.';
		$extentions = array('jpg' => 'jpeg', 'png' => 'png', 'ico' => 'x-icon', 'gif' => 'gif');
		$iconPath = null;
		foreach ($iconPathAndBaseNames as $iconPathAndBaseName)
		{
			foreach ($extentions as $extension => $type)
			{
				if (file_exists($iconPathAndBaseName . $extension))
				{
					$iconPath = $iconPathAndBaseName . $extension;
					$iconType = $type;
					break;
				} 	
			}
		}
		
		// If no icon found, get the default one.
		if (is_null($iconPath))
		{
			$iconPath = 'default-favicon.png';
			$iconType = 'png';
		}
		
		// Encode it in base64.
		return 'data:image/' . $iconType . ';base64,' . urlencode(base64_encode(file_get_contents($iconPath)));
	}
}
?>