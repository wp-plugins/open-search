<?php
/**
 * Render the Open search XML code.
 */
require_once('../../../wp-blog-header.php');
require_once('open-search-class.php');

header('Content-Type: text/xml; charset=' . get_option('blog_charset'), true);

OpenSearch::echoXml();
?>