<?php


namespace app\models;


use yii\db\ActiveRecord;

class Contact extends ActiveRecord
{

    public static function tableName()
    {
        return 'contacts';
    }

    public function rules()
    {
        return [
            [['first_name', 'email'], 'required'],
            ['email', 'email'],
        ];
    }


}