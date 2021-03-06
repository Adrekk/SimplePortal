<?php

/**
 * @package SimplePortal
 *
 * @author SimplePortal Team
 * @copyright 2020 SimplePortal Team
 * @license BSD 3-clause
 *
 * @version 2.3.8
 */

if (!defined('SMF'))
	die('Hacking attempt...');

/*
	void sportal_main()
		// !!!

	void sportal_credits()
		// !!!
*/

function sportal_main()
{
	global $context, $sourcedir;

	if(WIRELESS)
		redirectexit('action=forum');

	$context['page_title'] = $context['forum_name'];

	$actions = array(
		'addarticle' => array('PortalArticles.php', 'sportal_add_article'),
		'articles' => array('PortalArticles.php', 'sportal_articles'),
		'credits' => array('', 'sportal_credits'),
		'pages' => array('PortalPages.php', 'sportal_pages'),
		'removearticle' => array('PortalArticles.php', 'sportal_remove_article'),
		'shoutbox' => array('PortalShoutbox.php', 'sportal_shoutbox'),
	);

	if (!isset($_REQUEST['sa']) || !isset($actions[$_REQUEST['sa']]))
		$_REQUEST['sa'] = 'articles';

	if (!empty($actions[$_REQUEST['sa']][0]))
		require_once($sourcedir . '/' . $actions[$_REQUEST['sa']][0]);

	$actions[$_REQUEST['sa']][1]();
}

function sportal_credits()
{
	global $sourcedir, $context, $txt;

	require_once($sourcedir . '/PortalAdminMain.php');
	if (loadLanguage('SPortalAdmin') === false)
		loadLanguage('SPortalAdmin', 'english');

	sportal_information(false);

	$context['page_title'] = $txt['sp-info_title'];
	$context['sub_template'] = 'information';
}

?>