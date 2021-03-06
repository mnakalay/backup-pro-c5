<?php 
defined('C5_EXECUTE') or die('Access Denied.');
$tabs = array();
$tabs[] = array($context->action('view'), $view_helper->m62Lang('home_bp_dashboard_menu'), ($active_tab == 'dashboard' ? true : false));
$tabs[] = array($context->action('database_backups'), $view_helper->m62Lang('db_bp_dashboard_menu'), ($active_tab == 'db_backups' ? true : false));
$tabs[] = array($context->action('file_backups'), $view_helper->m62Lang('files_bp_dashboard_menu'), ($active_tab == 'file_backups' ? true : false));

$app = \Concrete\Core\Support\Facade\Application::getFacadeApplication();
$ui = $app->make('helper/concrete/ui');
echo $ui->tabs($tabs, false); 