<?php

namespace app\modules\models;

use Yii;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property integer $id
 * @property string $login
 * @property string $parol
 * @property string $ism
 * @property string $familiya
 * @property string $otchestvo
 * @property string $image
 * @property string $jins
 * @property string $authKey
 * @property string $accessToken
 * @property integer $bal
 * @property string $created_time
 * @property string $status
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'parol', 'ism', 'familiya', 'jins'], 'required'],
            [['jins', 'status'], 'string'],
            [['bal'], 'integer'],
            [['created_time'], 'safe'],
            [['login', 'ism', 'familiya', 'otchestvo', 'image', 'authKey', 'accessToken'], 'string', 'max' => 255],
            [['parol'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'login' => Yii::t('app', 'Login'),
            'parol' => Yii::t('app', 'Parol'),
            'ism' => Yii::t('app', 'Ism'),
            'familiya' => Yii::t('app', 'Familiya'),
            'otchestvo' => Yii::t('app', 'Otchestvo'),
            'image' => Yii::t('app', 'Rasm'),
            'jins' => Yii::t('app', 'Jins'),
            'authKey' => Yii::t('app', 'Auth Key'),
            'accessToken' => Yii::t('app', 'Access Token'),
            'bal' => Yii::t('app', 'Bal'),
            'created_time' => Yii::t('app', 'Created Time'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
    public static function get($id){
        return Users::findOne($id);
    }
    public static function getAll(){
        if (isset($_GET["id"])) {
          $id = $_GET["id"];
            return static::find()->where(["rukn_id" => $id])->orderBy(["id"=>SORT_DESC])
            ->all();
        }
        return static::find()->orderBy(["id"=>SORT_ASC])
            ->all();
    }
}
