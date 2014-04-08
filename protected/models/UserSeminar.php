<?php

/**
 * This is the model class for table "user_seminar".
 *
 * The followings are the available columns in table 'user_seminar':
 * @property integer $id
 * @property integer $user_id
 * @property integer $seminar_id
 * @property integer $grade_id
 * @property integer $time_id
 * @property integer $date_period_id
 * @property float $cost

 */
class UserSeminar extends CActiveRecord
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
		return 'user_seminar';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('title, price, favourite, active, type', 'required'),
            array('title', 'length', 'max' => 255),
            array('price', 'numeric',),
		);
	}

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'time'=>array(self::BELONGS_TO, 'Time', 'time_id'),
            'grade'=>array(self::BELONGS_TO, 'Grade', 'grade_id'),
            'date_period'=>array(self::BELONGS_TO, 'DatePeriod', 'date_period_id'),
            'seminar'=>array(self::BELONGS_TO, 'Seminar', 'seminar_id'),
            'user'=>array(self::BELONGS_TO, 'User', 'user_id'),
            'payments'=>array(self::HAS_MANY, 'Payment', 'user_seminar_id'),
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
/*	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
            'price' => 'Price',
            'favourite' => 'Favourite',
            'active' => 'Active',
            'type' => 'Type',

		);
	}*/

}