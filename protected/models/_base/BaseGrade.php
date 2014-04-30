<?php

/**
 * This is the model base class for the table "grade".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Grade".
 *
 * Columns in table "grade" available as properties of the model,
 * followed by relations of table "grade" available as properties of the model.
 *
 * @property string $id
 * @property string $title
 *
 * @property Seminar[] $seminars
 * @property StudentSeminars[] $studentSeminars
 */
abstract class BaseGrade extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'grade';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Grade|Grades', $n);
	}

	public static function representingColumn() {
		return 'title';
	}

	public function rules() {
		return array(
			array('title', 'required'),
			array('title', 'length', 'max'=>255),
			array('id, title', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'seminars' => array(self::MANY_MANY, 'Seminar', 'seminar_grade(grade_id, seminar_id)'),
			'studentSeminars' => array(self::HAS_MANY, 'StudentSeminars', 'grade_id'),
		);
	}

	public function pivotModels() {
		return array(
			'seminars' => 'SeminarGrade',
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'title' => Yii::t('app', 'Title'),
			'seminars' => null,
			'studentSeminars' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('title', $this->title, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}