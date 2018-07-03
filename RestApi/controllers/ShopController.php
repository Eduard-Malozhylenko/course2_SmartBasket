<?php
/**
 * Created by PhpStorm.
 * User: Eduard
 * Date: 25.05.2018
 * Time: 8:15
 */

namespace app\controllers;


use yii\rest\ActiveController;

class ShopController extends ActiveController
{
    public $modelClass = 'app\models\Shop';
}