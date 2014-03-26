<?php

/**
 * This is the model class for table "applicant".
 *
 * The followings are the available columns in table 'applicant':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $cv
 */
class Applicant extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return applicant the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'applicant';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('name, email, phone', 'required'),
            array('cv', 'required', 'message'=>'Please attach a resume.'),
            array('email', 'length', 'max' => 255),
            array('email', 'email'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'cv' => 'CV',
		);
	}

}