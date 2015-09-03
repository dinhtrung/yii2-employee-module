<?php

namespace hellobyte\employee\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\web\UploadedFile;

/**
 * This is the model class for table "employee".
 *
 * @property string $id
 * @property string $name
 * @property string $dob
 * @property string $address
 * @property string $email
 * @property string $photo
 * @property integer $sex
 * @property string $telephone
 * @property string $nationality
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 *
 * @property ECertificate[] $eCertificates
 */
class Employee extends \yii\db\ActiveRecord
{
	public $photoFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%employee}}';
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
            [['id', 'name', 'email', 'telephone', 'nationality'], 'required'],
            [['dob'], 'safe'],
            [['address'], 'string'],
            [['sex', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['id', 'name', 'email', 'photo', 'nationality'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 25],
            [['telephone'], 'string', 'max' => 20],
        		// Extra validation rules
	            [['email'], 'email'],
        		[['dob'], 'date', 'format' => 'php:d/m/Y'],
	            [['photoFile'], 'file', 'extensions' => "gif,png,jpg,jpeg"],
//        		[['iCertificates'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('hellobyte', 'ID'),
            'name' => Yii::t('hellobyte', 'Name'),
            'dob' => Yii::t('hellobyte', 'Dob'),
            'address' => Yii::t('hellobyte', 'Address'),
            'email' => Yii::t('hellobyte', 'Email'),
            'photo' => Yii::t('hellobyte', 'Photo'),
            'sex' => Yii::t('hellobyte', 'Sex'),
            'telephone' => Yii::t('hellobyte', 'Telephone'),
            'nationality' => Yii::t('hellobyte', 'Nationality'),
            'created_at' => Yii::t('hellobyte', 'Created At'),
            'created_by' => Yii::t('hellobyte', 'Created By'),
            'updated_at' => Yii::t('hellobyte', 'Updated At'),
            'updated_by' => Yii::t('hellobyte', 'Updated By'),
        		// End of GII generated attributes
        		'photoFile' => Yii::t('hellobyte', 'Upload Photo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getECertificates()
    {
        return $this->hasMany(ECertificate::className(), ['e_id' => 'id']);
    }

    /********* End of GII generated code **************/

    /**
     * Add some behavior to automate the insert / update of updated_by, created_by, updated_at, created_at
     * (non-PHPdoc)
     * @see \yii\base\Component::behaviors()
     */
   public function behaviors(){
   	return [
   			TimestampBehavior::className(),
   			BlameableBehavior::className(),
   	];
   }

   /** Convert date format to DB **/
   function afterValidate(){
   		$tmp = array_reverse(explode('/', $this->dob));
   		$this->dob = implode('-', $tmp);
   		return parent::afterValidate();
   }
   function afterFind(){
   		$tmp = array_reverse(explode('-', $this->dob));
   		$this->dob = implode('/', $tmp);

   	return parent::afterFind();
   }
   /** Ensure data integrity **/
   function beforeSave($insert){
   		$return = parent::beforeSave($insert);
   		if ($this->photoFile instanceof UploadedFile){
   			@mkdir($path = Yii::getAlias('@webroot/uploads/'), 775, true);
   			$this->photoFile->saveAs($path . $this->photoFile->name);
   			$this->photo = $this->photoFile->name;
   		}
   		return $return;
   }
   function beforeDelete(){
   	ECertificate::deleteAll(['e_id' => $this->id]);
   	@unlink(Yii::getAlias("@webroot/uploads/") . $this->photo);
   	return parent::beforeDelete();
   }

   function afterSave($insert, $changedAttributes){
   	if (!$insert && ($this->id != $this->getOldAttribute('id'))){
   		ECertificate::updateAll(['e_id' => $this->id], ['e_id' => $this->getOldAttribute('id')]);
   	}
   	return parent::afterSave($insert, $changedAttributes);
   }
}
