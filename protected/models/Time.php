<?php

/**
 * This is the model class for table "time".
 *
 * The followings are the available columns in table 'time':
 * @property integer $id
 * @property string $start_time
 * @property string $end_time
 * @property string $weekday
 * @property integer $seminar_id
 */
class Time extends CActiveRecord
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
		return 'time';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('weekday', 'length', 'max' => 45),
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
            'seminar'=>array(self::BELONGS_TO, 'Seminar', 'seminar_id'),
            'user_seminars'=>array(self::HAS_MANY, 'UserSeminar', 'time_id'),
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'start_time' => 'Start time',
            'end_time' => 'End time',
            'weekday' => 'Weekday',
            'seminar_id' => 'Seminar',
		);
	}

}