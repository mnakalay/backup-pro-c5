<?php
/**
 * mithra62 - Backup Pro for Concrete5
 *
 * @author		Eric Lamb <eric@mithra62.com>
 * @copyright	Copyright (c) 2016, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		3.0
 * @filesource 	./packages/backup_pro/controller.php
 */
 
namespace Concrete\Package\BackupPro;

defined('C5_EXECUTE') or die('Access Denied.');

use \Concrete\Core\Package\Package;
use \Concrete\Core\Page\Single as SinglePage;

/**
 * mithra62 - Concrete5 Package Controller Object
 *
 * Outlines what we're doing
 *
 * @package Concrete5
 * @author Eric Lamb <eric@mithra62.com>
 */
class Controller extends Package
{

    protected $pkgHandle = 'backup_pro';
    protected $appVersionRequired = '5.7.4.3b1';
    protected $pkgVersion = '1.0';

    public function getPackageDescription()
    {
        return t('Adds a searchable file library to a page.');
    }

    public function getPackageName()
    {
        return t('Backup Pro');
    }

    public function install()
    {
        if (version_compare(phpversion(), '5.4.0', '<')) {
            throw new \Exception('You must be run PHP 5.4 or greater to use this package.');
        }
        
        $pkg = parent::install();
        $page = SinglePage::add('/dashboard/backup_pro', $pkg);
        $page->updateCollectionName(t('Backup Pro'));
        SinglePage::add('/dashboard/backup_pro/dashboard', $pkg);
        SinglePage::add('/dashboard/backup_pro/backup_database', $pkg);
        SinglePage::add('/dashboard/backup_pro/backup_files', $pkg);
        SinglePage::add('/dashboard/backup_pro/settings', $pkg);
        
        $sp = SinglePage::add('/dashboard/backup_pro/settings/storage', $pkg);
        $sp->setAttribute('exclude_nav', true);
        
        $sp = SinglePage::add('/backup_pro/cron', $pkg);
        $sp->setAttribute('exclude_nav', true);
        return $pkg;
        
    }
    
    public function upgrade() {
        parent::upgrade();
    }
    
    public function uninstall()
    {
        parent::uninstall();
    } 
    
    public function on_start()
    {
        require $this->getPackagePath() . '/vendor/autoload.php';
    }
}