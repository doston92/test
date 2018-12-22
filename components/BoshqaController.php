<?php

namespace app\components;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
// use yii\web\Response;
use yii\filters\VerbFilter;
// use app\models\LoginForm;
// use app\models\ContactForm;
class BoshqaController extends \yii\web\Controller{
    public $layout = 'admin.php';
    
    public function __construct($id,$module,$config=[]){
        parent::__construct($id,$module,$config);
    }
    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','admin','view','update','delete','index'],
                'rules' => [
                    [
                        'actions' => ['logout','admin','view','update','delete','index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // [
                    //     'actions' => ['reg'],
                    //     'allow' => true,
                    //     'roles' => ['?'],
                    // ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
}
