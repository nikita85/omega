<?php

/**
 * This is the model base class for the table "seminar".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Seminar".
 *
 * Columns in table "seminar" available as properties of the model,
 * followed by relations of table "seminar" available as properties of the model.
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $price
 * @property integer $favourite
 * @property integer $active
 * @property string $type
 *
 * @property DatePeriod[] $datePeriods
 * @property Grade[] $grades
 * @property StudentSeminars[] $studentSeminars
 * @property TimeSlot[] $timeSlots
 */
abstract class BaseSeminar extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'seminar';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Seminar|Seminars', $n);
	}

	public static function representingColumn() {
		return 'title';
	}

	public function rules() {
		return array(
			array('title, price', 'required'),
			array('favourite, active', 'numerical', 'integerOnly'=>true),
			array('title, description', 'length', 'max'=>255),
			array('price', 'length', 'max'=>10),
			array('type', 'length', 'max'=>9),
			array('description, favourite, active, type', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, title, description, price, favourite, active, type', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'datePeriods' => array(self::HAS_MANY, 'DatePeriod', 'seminar_id'),
			'grades' => array(self::MANY_MANY, 'Grade', 'seminar_grade(seminar_id, grade_id)'),
			'studentSeminars' => array(self::HAS_MANY, 'StudentSeminars', 'seminar_id'),
			'timeSlots' => array(self::HAS_MANY, 'TimeSlot', 'seminar_id'),
		);
	}

	public function pivotModels() {
		return array(
			'grades' => 'SeminarGrade',
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'title' => Yii::t('app', 'Title'),
			'description' => Yii::t('app', 'Description'),
			'price' => Yii::t('app', 'Price'),
			'favourite' => Yii::t('app', 'Favourite'),
			'active' => Yii::t('app', 'Active'),
			'type' => Yii::t('app', 'Type'),
			'datePeriods' => null,
			'grades' => null,
			'studentSeminars' => null,
			'timeSlots' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('price', $this->price, true);
		$criteria->compare('favourite', $this->favourite);
		$criteria->compare('active', $this->active);
		$criteria->compare('type', $this->type, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}