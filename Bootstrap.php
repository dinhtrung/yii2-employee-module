<?php
namespace hellobyte\employee;

use yii\base\BootstrapInterface;
use yii\web\GroupUrlRule;
use yii\console\Application as ConsoleApplication;
use yii\base\Module;

class Bootstrap implements BootstrapInterface
{
    /** @var array Model's map */
    private $_modelMap = [
    ];

    /** @inheritdoc */
    public function bootstrap($app)
    {
        /** @var $module Module */
        if ($app->hasModule('hellobyte') && ($module = $app->getModule('hellobyte')) instanceof Module) {
            if ($app instanceof ConsoleApplication) {
                $module->controllerNamespace = 'hellobyte\employee\commands';
            } else {
                $configUrlRule = [
                    'prefix' => $module->urlPrefix,
                    'rules'  => $module->urlRules
                ];

                if ($module->urlPrefix != 'hellobyte') {
                    $configUrlRule['routePrefix'] = 'hellobyte';
                }

                $app->get('urlManager')->rules[] = new GroupUrlRule($configUrlRule);
            }

            $app->get('i18n')->translations['np*'] = [
                'class'    => 'yii\i18n\PhpMessageSource',
                'basePath' => __DIR__ . '/messages',
            ];
        }

    }
}