<?php
/**
 * Created by PhpStorm.
 * User: Eduard
 * Date: 25.05.2018
 * Time: 8:14
 */

namespace app\controllers;


use yii\rest\ActiveController;

class CompanyController extends ActiveController
{
    public $modelClass = 'app\models\Company';
}