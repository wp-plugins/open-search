<?php
/*
Plugin Name: Open search
Plugin URI: http://wp.darathor.com/mes-plugins-maison/open-search/
Author: Darathor
Author URI: http://wp.darathor.com
Description: Generates automatically the Open search document for your WordPress blog. It allows visitors to add your blog in search engine list of their browser.
Version: 1.0.1
*/

require_once('open-search-class.php');

OpenSearch::setUpInFrontoffice();
?>