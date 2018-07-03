<?php
/**
 * Created by PhpStorm.
 * User: Eduard
 * Date: 24.05.2018
 * Time: 23:22
 */

namespace app\controllers;


use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';


}