<?php
/**
 * Return a list of menu item suitable for display in the main Nav
 */
return [
	['label' => \Yii::t('hellobyte', 'Numbering Plans'), 'url' => '#', 'items' => [
			['label' => \Yii::t('hellobyte', 'Country'), 'url' => ['/np/country/index']],
			['label' => \Yii::t('hellobyte', '-- Country Code'), 'url' => ['/np/country-code/index']],
			['label' => \Yii::t('hellobyte', '-- MCC'), 'url' => ['/np/mobile-country-code/index']],
			['label' => \Yii::t('hellobyte', 'Operators'), 'url' => ['/np/network-operator/index']],
			['label' => \Yii::t('hellobyte', '-- MNC'), 'url' => ['/np/network-code/index']],
			['label' => \Yii::t('hellobyte', '-- MDC'), 'url' => ['/np/network-destination-code/index']],
		]
	],
];