<?php

namespace ZendModuleLayouts;

/**
 * Module-specific layout
 *
 * @see https://github.com/EvanDotPro/EdpModuleLayouts
 */
class Module
{

	public function onBootstrap ($e)
	{
		$e->getApplication()
			->getEventManager()
			->getSharedManager()
			->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function  ($e)
		{
			$controller = $e->getTarget();
			$controllerClass = get_class($controller);
			$moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
			$config = $e->getApplication()
				->getServiceManager()
				->get('config');
			if (isset($config['module_layouts'][$moduleNamespace])) {
				$controller->layout($config['module_layouts'][$moduleNamespace]);
			}
		}, 100);
	}
}