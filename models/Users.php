<?php

namespace app\models;

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
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
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
    public function saqlash()
    {
            $model = new \app\models\Users();
        if ($model->load(Yii::$app->request->post())) {
            $image = Null;
            if (\yii\web\UploadedFile::getInstance($model,'image')) {
                $vaqt = date('Y-d-H-m-i');
                $model->image = \yii\web\UploadedFile::getInstance($model,'image');
                $model->image->saveAs('papka/uzer/'.$vaqt.'.'.$model->image->extension);
                $image = 'papka/uzer/'.$vaqt.'.'.$model->image->extension;
            }
            $time = date('Y-m-d H:i:s');
            $time = date('Y-m-d H:i:s');
            $yuser = $model;
            $yuser->login = $model->login;
            $yuser->parol = md5($model->parol);
            $yuser->ism = $model->ism;
            $yuser->familiya = $model->familiya;
            $yuser->otchestvo = $model->otchestvo;
            $yuser->bal = 0;
            $yuser->image = $image;
            $yuser->created_time = $time;
            $yuser->status = 'faol';
            $yuser->authKey = Yii::$app->security->generateRandomString();
            $yuser->accessToken = Yii::$app->security->generateRandomString();
            $yuser->save();
            if($yuser->save())
                Yii::$app->user->login(\app\models\Users::findByUsername($model->login),3600*24*30);
            // Yii::$app->user->login("admin", 3600*24*30);
            return true;
        }
            return false;
    }
    public function izmenit($edit)
    {
        $model = \app\models\Users::findOne($edit);
        if ($model->load(Yii::$app->request->post())) {
            return true;
        }
            return false;
    }
    public static function plyus($bal){
        $yuzer = static::get(Yii::$app->user->identity->id);
        $yuzer->updateCounters(['bal'=>$bal]);
        $yuzer->save();
    }
    public static function findIdentity($id){
        return static::findOne($id);
    }

    public static function findByUsername($login){
        return static::findOne(['login'=>$login]);
    }

    public function getId(){
        return $this->id;
    }

    public function getAuthKey(){
        return $this->authKey;
    }

    public function validateAuthKey($authKey){
        return $this->authKey === $authKey;
    }

    public function validatePassword($password){
        return $this->parol === md5($password);
    }

    public static function findIdentityByAccessToken($token,$type=null){
        return static::findOne(['accessToken'=>$token]);
    }
    public static function get($id){
        return static::findOne($id);
    }
    public static function getAll(){
        return static::find()->orderBy(['bal'=>SORT_DESC])
            ->all();
    }
    public static function getUch(){
        return static::find()->orderBy(['bal'=>SORT_DESC])
            ->limit(3)
            ->all();
    }
}
