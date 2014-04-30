<?php

/**
 * This is the model base class for the table "seminar_grade".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "SeminarGrade".
 *
 * Columns in table "seminar_grade" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $seminar_id
 * @property string $grade_id
 *
 */
abstract class BaseSeminarGrade extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'seminar_grade';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'SeminarGrade|SeminarGrades', $n);
	}

	public static function representingColumn() {
		return array(
			'seminar_id',
			'grade_id',
		);
	}

	public function rules() {
		return array(
			array('seminar_id, grade_id', 'required'),
			array('seminar_id, grade_id', 'length', 'max'=>11),
			array('seminar_id, grade_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'seminar_id' => null,
			'grade_id' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('seminar_id', $this->seminar_id);
		$criteria->compare('grade_id', $this->grade_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}