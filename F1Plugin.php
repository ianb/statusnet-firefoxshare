<?php
/**
 * A plugin to add F1/Firefox Share support
 *
 * @category  F1
 * @package   StatusNet
 * @author    Ian Bicking <ianb@mozilla.com>
 * @copyright Mozilla Corp
 */

if (!defined('STATUSNET')) {
    // This check helps protect against security problems;
    // your code file can't be executed directly from the web.
    exit(1);
}

define('F1_PLUGIN_VERSION', '0.1');

class F1Plugin extends Plugin
{

    // By default, notice-title widget will be available to all users.
    // With restricted on, only users who have been granted the
    // "richedit" role get it.
    public $restricted = false;

    function initialize()
    {
        return true;
    }
                    
    /**
     * Provide plugin version information.
     *
     * This data is used when showing the version page.
     *
     * @param array &$versions array of version data arrays; see EVENTS.txt
     *
     * @return boolean hook value
     */

    function onPluginVersion(&$versions)
    {
        $url = 'http://statusnet.ianbicking.org';

        $versions[] = array('name' => 'F1',
                            'version' => F1_PLUGIN_VERSION,
                            'author' => 'Ian Bicking',
                            'homepage' => $url,
                            'rawdescription' =>
                            _m('Adds F1/Firefox Share support.'));
        return true;
    }

    function onRouterInitialized($m)
    {
        $m->connect('main/firefox-share',
                    array('action' => 'firefoxshare'));
        $m->connect('main/manifest.webapp',
                    array('action' => 'openwebappmanifest'));
        return true;
    }

    function onAutoload($cls)
    {
        $dir = dirname(__file__);
        switch ($cls)
        {
        /*case 'OpenwebappmanifestAction':
            include_once $dir . '/' . 'manifest.webapp.php';
            return false;
        case 'FirefoxshareAction':
            include_once $dir . '/' . 'firefoxshare.php';
            return false; */
        default:
            return true;
        }
    }
    
    function onStartShowHeadElements($page) {
      $page->element('link', array('rel'=>'application-manifest',
                                   'href'=>common_path('main/manifest.webapp')));
      return true;
    }

}

class OpenwebappmanifestAction extends Action
{
    var $user = null;
    var $gc = null;
    
    function handle($args)
    {
        header('Content-Type: application/x-web-app-manifest+json');
        include_once(dirname(__file__) . '/manifest.webapp.php');
        return false;
    }
    
}

class FirefoxshareAction extends Action
{
    var $user = null;
    var $gc = null;
    
    function handle($args)
    {
        include_once(dirname(__FILE__) . '/firefoxshare.php');
        return false;
    }

}
