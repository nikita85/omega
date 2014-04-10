<?php

/**
 * This is the model class for table "seminar".
 *
 * The followings are the available columns in table 'seminar':
 * @property integer $id
 * @property string $title
 * @property float $price
 * @property boolean $favourite
 * @property boolean $active
 * @property string $type
 */
class Seminar extends CActiveRecord
{
    const TYPE_SUMMER = 'summer';
    const TYPE_TRIMESTER = 'trimester';

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
		return 'seminar';
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
            array('price', 'numerical',),
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
            'times'=>array(self::HAS_MANY, 'Time', 'seminar_id'),
            'date_periods'=>array(self::HAS_MANY, 'DatePeriod', 'seminar_id'),
/*            'seminarGrades' => array(self::HAS_MANY, 'SeminarGrade', 'seminar_id'),
            'grades' => array(self::HAS_MANY, 'Grade', 'grade_id', 'through' => 'seminarGrades'),*/
            'grades'=>array(self::MANY_MANY, 'Grade', 'seminar_grade(seminar_id, grade_id)'),
            'user_seminars'=>array(self::HAS_MANY, 'UserSeminar', 'seminar_id'),
        );
    }

    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('title',$this->title,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
            'price' => 'Price',
            'favourite' => 'Favourite',
            'active' => 'Active',
            'type' => 'Type',

		);
	}

    public static function getTypes()
    {
        return [self::TYPE_SUMMER => 'summer', self::TYPE_TRIMESTER => 'trimester'];
    }

}