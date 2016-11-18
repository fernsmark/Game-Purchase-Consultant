<?php
define('DRUPAL_ROOT', getcwd());

include_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

if (!isset($_GET['cron_key']) || variable_get('cron_key', 'drupal') != $_GET['cron_key'])
{
  watchdog('cron', 'Cron could not run because an invalid key was used.', array(), WATCHDOG_NOTICE);
  drupal_access_denied();
}
elseif (variable_get('maintenance_mode', 0))
{
  watchdog('cron', 'Cron could not run because the site is in maintenance mode.', array(), WATCHDOG_NOTICE);
  drupal_access_denied();
}
else
{
	drupal_cron_run();
	include '/myfiles/dbc.php';
	include '/myfiles/simple_html_dom.php';

	$sql = "select g.game_title, p.platform_name, gp.gp_id
			from game g, platform p, game_platform gp
			where gp.game_id = g.game_id and p.platform_id = gp.platform_id";

	$result = mysqli_query($con, $sql) or die(mysqli_error($con));

	foreach($result as $temp)
	{
		$url = 'http://videogames.pricecharting.com/game/'.str_replace(" ","-",$temp['platform_name']).'/'.str_replace(" ","-",$temp['game_title']);
		$html = file_get_html($url);
		$price_array = $html->find('#new_price');
		
		if(!empty($price_array))
		{
			preg_match_all('!\d+!', $price_array[0], $matches);
			$price = (float)$matches[0][0]+(float)$matches[0][1]/100;
			$sql = "insert into price (gp_id,month,year,price) values({$temp['gp_id']},".date('m').",".date('Y').",{$price})";
			mysqli_query($con, $sql) or die(mysqli_error($con));
		}
		else
		{
			$sql = "insert into price (gp_id,month,year,price) values({$temp['gp_id']},".date('m').",".date('Y').",9.99)";
			mysqli_query($con, $sql) or die(mysqli_error($con));
		}
	}
  
}
