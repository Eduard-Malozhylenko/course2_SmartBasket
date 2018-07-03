<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "buy".
 *
 * @property int $id
 * @property int $id_buy
 * @property int $id_user
 * @property int $id_product
 * @property int $id_shop
 * @property int $price
 *
 * @property User $user
 * @property Product $product
 * @property Shop $shop
 */
class Buy extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'buy';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_buy', 'id_user', 'id_product', 'id_shop', 'price'], 'required'],
            [['id_buy', 'id_user', 'id_product', 'id_shop', 'price'], 'integer'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['id_product'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['id_product' => 'id']],
            [['id_shop'], 'exist', 'skipOnError' => true, 'targetClass' => Shop::className(), 'targetAttribute' => ['id_shop' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_buy' => 'Id Buy',
            'id_user' => 'Id User',
            'id_product' => 'Id Product',
            'id_shop' => 'Id Shop',
            'price' => 'Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shop::className(), ['id' => 'id_shop']);
    }
}
