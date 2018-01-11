<?php
/**
 * @version 0.1
 * @package Observetable
 * @subpackage Tools
 * @copyright (C) 2017 Garstud - www.garstud.com
 * @license GNU/GPL v2
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

if(!defined('DS')) DEFINE('DS', DIRECTORY_SEPARATOR); 

/**
 * JTable Observer Plugin
 */
class plgSystemObservetable extends JPlugin
{
	/**
	 * Application object.
	 *
	 * @var    JApplicationCms
	 * @since  3.3
	 */
	protected $app;

	/**
	 * Constructor.
	 *
	 * @param   object  &$subject  The object to observe.
	 * @param   array   $config    An optional associative array of configuration settings.
	 *
	 * @since   1.5
	 */
	public function __construct(&$subject, $config)
	{
		parent::__construct($subject, $config);

		// Get the application if not done by JPlugin. This may happen during upgrades from Joomla 2.5.
		if (!$this->app)
		{
			$this->app = JFactory::getApplication();
		}
	}

	/**
	 * Method to Observer from custom library.
	 *
	 * return  void
	 */
	public function onAfterInitialise()
	{
		// get plugin params
		$classObservable = $this->params->get('pobservable');
		$classObserver = $this->params->get('pobserver');
		$classLibPath = $this->params->get('pobserver_path');
		$classPrefix = $this->params->get('pobserver_prefix');
		$isShowErrors = $this->params->get('perror_disp');
		$errorLevel = $this->params->get('perror_priorities');

		if(JDEBUG) {
			if(function_exists("dump")) dump($classLibPath, get_class($this)." ".__FUNCTION__." path");
			$this->app->enqueueMessage(get_class($this)." ".__FUNCTION__." JLoader::registerPrefix ".$classPrefix);
			$this->app->enqueueMessage(get_class($this)." ".__FUNCTION__." path to look : ".JPATH_LIBRARIES.$classLibPath);
		}
		
		try {
			JLoader::registerPrefix($classPrefix, JPATH_ROOT.$classLibPath, false);

			if (class_exists($classObserver)) {
				// Finally, the binding is made outside the observable and observer classes, using:
				JObserverMapper::addObserverClassToClass($classObserver ,$classObservable , array('paramName' => 'paramValue'));
				// where the last array will be provided to the observer instanciator function createObserver.
			} else {
				throw new UnexpectedValueException("Observer classname '".$classObserver."' not found within the path and the auto-loader prefix setted. It can't be added to JObserverMapper." );
			}

			if (!class_exists($classObservable)) {
				throw new UnexpectedValueException("Observable classname '".$classObservable."' not found. It can't be observed." );
			}
		}
		catch(Exception $e) {
			switch (get_class($e)) {
				case 'RuntimeException' : 
					if($isShowErrors) $app->enqueueMessage("Observer library path '". JPATH_ROOT.$classLibPath."' not found ! " . $e->getMessage() , $errorLevel);
					break;
				case 'UnexpectedValueException' : 
					if($isShowErrors) $app->enqueueMessage($e->getMessage() , $errorLevel);
					break;
			}
			return "";
		}

		if(JDEBUG) {
			if(function_exists("dump"))	dump($classPrefix, get_class($this)." ".__FUNCTION__." addObserverClassToClass '".$classObserver ."' to '".$classObservable ."'");
			$this->app->enqueueMessage(get_class($this)." ".__FUNCTION__." addObserverClassToClass '".$classObserver ."' to '".$classObservable ."'");
		}
	}
}
