<?php

namespace hellobyte\employee\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "e_certificate".
 *
 * @property string $e_id
 * @property string $degree
 * @property string $year
 * @property string $certificated_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Employee $e
 */
class ECertificate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'e_certificate';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('testDb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['e_id', 'degree', 'year', 'certificated_by'], 'required'],
            [['year'], 'safe'],
            [['created_at', 'updated_at'], 'integer'],
            [['e_id', 'degree', 'certificated_by'], 'string', 'max' => 255],
            [['e_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['id']],
        		// Constraint on creating ECertificate
        		[['degree', 'year', 'certificated_by'], 'unique', 'targetAttribute' => ['e_id', 'degree', 'year', 'certificated_by']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'e_id' => Yii::t('hellobyte', 'E ID'),
            'degree' => Yii::t('hellobyte', 'Degree'),
            'year' => Yii::t('hellobyte', 'Year'),
            'certificated_by' => Yii::t('hellobyte', 'Certificated By'),
            'created_at' => Yii::t('hellobyte', 'Created At'),
            'updated_at' => Yii::t('hellobyte', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getE()
    {
        return $this->hasOne(Employee::className(), ['id' => 'e_id']);
    }

    /************ End of GII code ****************/

    public function behaviors(){
    	return [
    			TimestampBehavior::className()
    	];
    }
}
