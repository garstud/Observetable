<?php
/**
 * @package     Observetable
 * @subpackage  ObsEveryWhere
 *
 * @copyright   Copyright (C) 2017 - Garstud - www.garstud.com
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
	 *
	 * @param   mixed    $keys   An optional primary key value to load the row by, or an array of fields to match.  If not
	 *                           set the instance property value is used.
	 * @param   boolean  $reset  True to reset the default values before loading the new row.
	 *
	 * @return  void
	 *
	 * @since   3.1.2
	 */
	public function onBeforeLoad($keys, $reset )
	{
		self::$app->enqueueMessage("Library JTableObserverContent onBeforeLoad keys=".serialize($keys), 'message');
	}
	
	/**
	 * Post-processor for $table->load($keys, $reset)
	 *
	 * @param   boolean  &$result  The result of the load
	 * @param   array    $row      The loaded (and already binded to $this->table) row of the database table
	 *
	 * @return  void
	 *
	 * @since   3.1.2
	 */
	public function onAfterLoad(&$result, $row)
	{
		self::$app->enqueueMessage("Library JTableObserverContent onAfterLoad row=".serialize($row), 'message');
	}
	
	/**
	 * Pre-processor for $table->store($updateNulls)
	 *
	 * @param   boolean  $updateNulls  The result of the load
	 * @param   string   $tableKey     The key of the table
	 *
	 * @return  void
	 *
	 * @since   3.1.2
	 */
	public function onBeforeStore($updateNulls, $tableKey)
	{
		self::$app->enqueueMessage("Library JTableObserverContent onBeforeStore tableKey=".$tableKey, 'message');
	}
	
	/**
	 * Post-processor for $table->store($updateNulls)
	 *
	 * @param   boolean  &$result  The result of the store
	 *
	 * @return  void
	 *
	 * @since   3.1.2
	 */
	public function onAfterStore(&$result)
	{
		self::$app->enqueueMessage("Library JTableObserverContent onAfterStore result=".serialize($result), 'message');
	}

	/**
	 * Pre-processor for $table->delete($pk)
	 *
	 * @param   mixed  $pk  An optional primary key value to delete.  If not set the instance property value is used.
	 *
	 * @return  void
	 *
	 * @since   3.1.2
	 * @throws  UnexpectedValueException
	 */
	public function onBeforeDelete($pk)
	{
 		self::$app->enqueueMessage("Library JTableObserverContent onBeforeDelete pk=".$pk, 'message');
	}

	/**
	 * Post-processor for $table->delete($pk)
	 *
	 * @param   mixed  $pk  The deleted primary key value.
	 *
	 * @return  void
	 *
	 * @since   3.1.2
	 */	
	public function onAfterDelete($pk)
	{
   		self::$app->enqueueMessage("Library JTableObserverContent onAfterDelete pk=".$pk, 'message');
	}	
}
