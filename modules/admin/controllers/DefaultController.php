<?php

namespace app\modules\admin\controllers;

use app\components\BoshqaController;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends BoshqaController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
