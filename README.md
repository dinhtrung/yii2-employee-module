Yii2 Employee Module
==============

You are required to prepare a simple employee management system (EMS) to manage the
employee details based on a dummy data collection form given as below.

The EMS system should provide two web based portals, one for the user for managing the
employee details and another for the management of users (admin control panel).


## Install

### Using composer

Modify the composer.json of your project:

~~~
[json]
 "repositories": [
        ...
        {
          "type": "vcs",
          "url": "https://github.com/hellobyte/yii2-employee-module",
          "reference":"master"
        },
        ...
],
"require": {
                ...
                "hellobyte/yii2-employee-module":"*",
                ...
        },
~~~


### Manual Install

Unzip the files into `vendor/hellobyte` folder (`vendor/hellobyte/yii2-employee-module`).

__Update `vendor\yiisoft\extensions.php`__

Add the following lines into end of the file:

~~~
'hellobyte/yii2-employee-module' =>
  array (
    'name' => 'hellobyte/yii2-employee-module',
    'version' => '9999999-dev',
    'alias' =>
    array (
      '@hellobyte/employee' => $vendorDir . '/hellobyte/yii2-employee-module',
    ),
    'bootstrap' => 'hellobyte\\employee\\Bootstrap',
  ),
 ~~~

This will ensure the app found the `Bootstrap.php` of module then load it correctly.

__Update `vendor\composer\autoload_psr4.php`__

Add the following lines into end of the file:

~~~
return array(
	....
	'hellobyte\\employee\\' => array($vendorDir . '/hellobyte/yii2-employee-module'),
	...
);
~~~

So that the app know which path to find the module's code.


### Integrate the module into app

Update the `config/web.php` and `config/console.php` to include the module code into it.

~~~
'modules' => [
	...
	'hellobyte' => 'hellobyte\employee\EmployeeModule',
	...
],
~~~


### DB Setup

Then run the following commands:

~~~
[bash]
php composer.phar update
./yii migrate/up --migrationPath=@vendor/hellobyte/yii2-employee-module/migrations
~~~

Last, add the module to your config file

~~~
[php]
	'modules' => [
		...
		'hellobyte' => 'hellobyte\employee\EmployeeModule',
		...
	],
~~~

In your main layout file:

~~~
[php]
$items =  [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
        Yii::$app->user->isGuest ?
            ['label' => 'Login', 'url' => ['/site/login']] :
            ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']],
    ];
 foreach (\Yii::$app->modules as $id => $child) {
	$module = \Yii::$app->getModule($id);
	if ($module && (file_exists($phpFile = $module->getViewPath() . '/layouts/_menu' . ucfirst($id) . '.php'))) {
		$items = array_merge_recursive($items, require($phpFile));
	}
}
~~~