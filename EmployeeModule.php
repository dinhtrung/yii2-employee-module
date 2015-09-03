<?php

namespace hellobyte\employee;

class EmployeeModule extends \yii\base\Module
{
	/**
	 * @var string The prefix for user module URL.
	 * @See [[GroupUrlRule::prefix]]
	 */
	public $urlPrefix = 'hellobyte';
	/** @var array The rules to be used in URL management. */
	public $urlRules = [];
	public $defaultRoute = 'network-operator';
}
