<?php

/**
 * This is the model class for table "date_period".
 *
 * The followings are the available columns in table 'date_period':
 * @property integer $id
 * @property string $start_date
 * @property string $end_date
 * @property string $description
 * @property integer $seminar_id
 */
class DatePeriod extends CActiveRecord
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
		return 'date_period';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('start_date, end_date', 'required'),
            array('description', 'length', 'max' => 255),
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
            'user_seminars'=>array(self::HAS_MANY, 'UserSeminar', 'date_period_id'),
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