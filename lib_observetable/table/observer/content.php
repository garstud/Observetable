<?php
/**
 * @package     Observetable
 * @subpackage  Table
 *
 * @copyright   Copyright (C) 2017 - Agerix
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

class JTableObserverContent extends JTableObserver
{
	static private $app;
	
	/**
	 * Creates the associated observer instance and attaches it to the $observableObject
	 *
	 * @param   JObservableInterface  $observableObject  The subject object to be observed
	 * @param   array                 $params            ( 'typeAlias' => $typeAlias )
	 *
	 * @return  JTableObserver
	 *
	 * @since   3.2
	 */
	public static function createObserver(JObservableInterface $observableObject, $params = array())
	{
		self::$app = JFactory::getApplication();
		self::$app->enqueueMessage("Library JTableObserverContent createObserver", 'message');

		$observer = new self($observableObject);

//		$observer->typeAliasPattern = $params['typeAlias'];

		return $observer;
	}

	/**
   * Pre-processor for $table->load($keys, $reset)
	 */
	public function onBeforeLoad($keys, $reset )
	{
		self::$app->enqueueMessage("Library JTableObserverContent onBeforeLoad keys=".serialize($keys), 'message');
	}
	
	public function onAfterLoad(&$result, $row)
	{
		self::$app->enqueueMessage("Library JTableObserverContent onAfterLoad row=".serialize($row), 'message');
	}
	
	public function onBeforeStore($updateNulls, $tableKey)
	{
		//...
	}
	
	/**
	 * Post-processor for $table->store($updateNulls)
	 * @param   boolean  &$result  The result of the load
	 * @return  void
	 * @since   3.2
	 */
	public function onAfterStore(&$result)
	{
		self::$app->enqueueMessage("Library JTableObserverContent onAfterStore result=".serialize($result), 'message');
	}

	/**
	 * Pre-processor for $table->delete($pk)
	 * @param   mixed  $pk  An optional primary key value to delete.  If not set the instance property value is used.
	 * @return  void
	 *
	 * @since   3.2
	 * @throws  UnexpectedValueException
	 */
	public function onBeforeDelete($pk)
	{
    //...
	}
	
	public function onAfterDelete($pk)
	{
    //...
	}	
}
