<?php
/**
 * @package
 * @SubPackage
 * @copyright    Copyright (C) 2015 Magnetic Merchandising Inc. All rights reserved.
 * @license      No License
 * @link        http://magneticmerchandising.com
 */

defined('_JEXEC') or die;

/**
 * Class PlgSystemVerge
 * This class will serve generally as the Verge system plugin.
 * We'll add system level functionality here over time.
 */
class PlgSystemVerge extends JPlugin
{

    /**
     * Run the initialization we need.
     */
	public function onAfterInitialise()
	{
	    $this->handleRouting();
	}

    /**
     * Point the route to com_comprofiler
     */
	protected function handleRouting()
    {
        $app = JFactory::getApplication();

        if ($app->isAdmin()) {
            return;
        }

        $router = $app->getRouter();
        $router->attachBuildRule(array($this, 'buildRule'));

        return $this;
    }

    public function buildRule(&$router, &$uri)
    {
        if ($uri->getVar('option') == 'com_k2' && $uri->getVar('task') == 'user' && $uri->getVar('view') == 'itemlist')
        {
            $uri->setVar('option', 'com_comprofiler');
            $uri->setVar('view', 'userprofile');
            $uri->setVar('user', $uri->getVar('id'));

            $uri->delVar('layout');
            $uri->delVar('task');
            $uri->delVar('id');
        }
    }
}