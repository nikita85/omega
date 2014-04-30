<?php

/**
 * This is the model base class for the table "forms".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Forms".
 *
 * Columns in table "forms" available as properties of the model,
 * followed by relations of table "forms" available as properties of the model.
 *
 * @property integer $id
 * @property string $table
 *
 * @property EnrollForms[] $enrollForms
 */
abstract class BaseForms extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'forms';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Forms|Forms', $n);
	}

	public static function representingColumn() {
		return 'table';
	}

	public function rules() {
		return array(
			array('table', 'required'),
			array('table', 'length', 'max'=>255),
			array('id, table', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'enrollForms' => array(self::HAS_MANY, 'EnrollForms', 'form_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'table' => Yii::t('app', 'Table'),
			'enrollForms' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('table', $this->table, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}