<?php

/**
 * This is the model class for table "seminar_grade".
 *
 * The followings are the available columns in table 'seminar_grade':
 * @property integer $grade_id
 * @property integer $seminar_id
 */
class SeminarGrade extends CActiveRecord
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
		return 'seminar_grade';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('seminar_id, grade_id', 'required'),
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
            'grade'=>array(self::BELONGS_TO, 'Grade', 'grade_id'),
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
            'seminar_id' => 'Seminar',
            'grade_id' => 'Grade',
		);
	}

}