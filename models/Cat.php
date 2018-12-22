<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%cat}}".
 *
 * @property integer $user_id
 * @property integer $word_id
 * @property string $created_time
 * @property integer $bal
 */
class Cat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cat}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'word_id', 'created_time', 'bal'], 'required'],
            [['user_id', 'word_id', 'bal'], 'integer'],
            [['created_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'word_id' => Yii::t('app', 'Word ID'),
            'created_time' => Yii::t('app', 'Created Time'),
            'bal' => Yii::t('app', 'Bal'),
        ];
    }
    public static function check($id){
        if(!Yii::$app->user->isGuest)
            return static::find()
           ->where(['word_id'=>$id,'user_id'=>Yii::$app->user->identity->id])->andWhere(['!=', 'bal', 0])->count();
        return false;
    }
    public static function getOne(){
        if(!Yii::$app->user->isGuest)
            return static::find()
           ->where(['user_id'=>Yii::$app->user->identity->id])->andWhere(['!=', 'bal', 0])
           ->orderBy(['created_time'=>SORT_DESC])
           ->limit(1)
           ->one();
        return false;
    }
    public static function getCount(){
        if(!Yii::$app->user->isGuest)
            return static::find()
               ->where(['user_id'=>Yii::$app->user->identity->id])->andWhere(['!=', 'bal', 0])->count();
        return false;
    }
    public static function getCountAll(){
        if(!Yii::$app->user->isGuest){
            return static::find()
               ->where(['user_id'=>Yii::$app->user->identity->id])->count();
        }
        return false;
    }
    public static function getWordCount($id){
        if(!Yii::$app->user->isGuest)
            return static::find()
            ->where(['word_id'=>$id,'user_id'=>Yii::$app->user->identity->id])->count();
        return false;
    }
    public static function getTrueCount($id){
        if(!Yii::$app->user->isGuest)
            return static::find()
               ->where(['word_id'=>$id,'user_id'=>Yii::$app->user->identity->id])->andWhere(['!=', 'bal', 0])->count();
        return false;
    }
    public static function getLast(){
        if(!Yii::$app->user->isGuest){
            return static::find()->orderBy(['created_time'=>SORT_DESC])
                ->where(['user_id'=>Yii::$app->user->identity->id])->andWhere(['!=', 'bal', 0])
                ->limit(1)
                ->one();
        }
        return false;
    }
}
