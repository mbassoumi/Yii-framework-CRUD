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
            [['first_name','last_name', 'email', 'marks', 'status'], 'required'],
            ['email', 'email'],
            ['marks', 'number'],
//            [['profile_picture'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],

        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->profile_picture->saveAs('uploads/' . $this->profile_picture->baseName . '.' . $this->profile_picture->extension);
            return true;
        } else {
            return false;
        }
    }


}