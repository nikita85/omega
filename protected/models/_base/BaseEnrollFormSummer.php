<?php

/**
 * This is the model base class for the table "enroll_form_summer".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "EnrollFormSummer".
 *
 * Columns in table "enroll_form_summer" available as properties of the model,
 * followed by relations of table "enroll_form_summer" available as properties of the model.
 *
 * @property integer $enroll_form_id
 * @property string $student_name
 * @property string $gender
 * @property string $current_school
 * @property string $student_address
 * @property string $city
 * @property string $student_home_phone
 * @property string $student_cell_phone
 * @property string $student_email
 * @property string $parent_name_1
 * @property string $parent_email_1
 * @property string $parent_name_2
 * @property string $parent_email_2
 * @property string $parent_name_emergency
 * @property string $parent_phone_emergency
 * @property string $parent_cell_emergency
 * @property string $person_name_emergency
 * @property string $person_cell_emergency
 * @property string $person_phone_emergency
 * @property string $person_relation_to_student
 * @property string $physician_name
 * @property string $physician_phone
 * @property string $dentist_name
 * @property string $dentist_phone
 * @property string $food_alergies
 * @property string $medication_alergies
 * @property string $medication_currently_taken
 * @property string $last_tetanus_shot
 * @property string $submit_date
 * @property string $order_id
 *
 * @property EnrollForms $enrollForm
 * @property Orders $order
 */
abstract class BaseEnrollFormSummer extends GxActiveRecord {

    public $filter_seminar;
    public $filter_grade;
    public $filter_timeSlot;
    public $filter_datePeriod;
    public $payment_status; // this property is for search purposes only

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'enroll_form_summer';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'EnrollFormSummer|EnrollFormSummers', $n);
	}

	public static function representingColumn() {
		return 'student_name';
	}

	public function rules() {
		return array(
			array('enroll_form_id, student_name, gender, student_address, student_cell_phone, student_email, parent_name_1, parent_name_emergency, parent_phone_emergency, parent_cell_emergency, person_name_emergency, person_cell_emergency, person_phone_emergency, person_relation_to_student, physician_name, physician_phone, dentist_name, dentist_phone, submit_date, city', 'required'),
			array('enroll_form_id', 'numerical', 'integerOnly'=>true),
			array('student_name, current_school, student_address, student_email, parent_name_1, parent_email_1, parent_name_2, parent_email_2, parent_name_emergency, person_name_emergency, person_relation_to_student, physician_name, dentist_name, food_alergies, medication_alergies, medication_currently_taken, city', 'length', 'max'=>255),
			array('gender', 'length', 'max'=>6),
            array('student_email', 'email'),
			array('student_home_phone, student_cell_phone, parent_phone_emergency, parent_cell_emergency, person_cell_emergency, person_phone_emergency, physician_phone, dentist_phone', 'length', 'max'=>12),
			array('order_id', 'length', 'max'=>11),
			array('last_tetanus_shot', 'safe'),
			array('current_school, student_home_phone, parent_email_1, parent_name_2, parent_email_2, food_alergies, medication_alergies, medication_currently_taken, last_tetanus_shot, order_id', 'default', 'setOnEmpty' => true, 'value' => null),
			array('filter_seminar, filter_grade, filter_timeSlot, filter_datePeriod, enroll_form_id, student_name, gender, current_school, student_address, student_home_phone, student_cell_phone, student_email, parent_name_1, parent_email_1, parent_name_2, parent_email_2, parent_name_emergency, parent_phone_emergency, parent_cell_emergency, person_name_emergency, person_cell_emergency, person_phone_emergency, person_relation_to_student, physician_name, physician_phone, dentist_name, dentist_phone, food_alergies, medication_alergies, medication_currently_taken, last_tetanus_shot, submit_date, order_id, city, payment_status', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'enrollForm' => array(self::BELONGS_TO, 'EnrollForms', 'enroll_form_id'),
			'order' => array(self::BELONGS_TO, 'Orders', 'order_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'enroll_form_id' => null,
			'student_name' => Yii::t('app', 'Student Name'),
			'gender' => Yii::t('app', 'Gender'),
			'current_school' => Yii::t('app', 'Current School'),
			'student_address' => Yii::t('app', 'Student Address'),
			'student_home_phone' => Yii::t('app', 'Student Home Phone'),
			'student_cell_phone' => Yii::t('app', 'Student Cell Phone'),
			'student_email' => Yii::t('app', 'Student Email'),
			'parent_name_1' => Yii::t('app', 'Parent Name 1'),
			'parent_email_1' => Yii::t('app', 'Parent Email 1'),
			'parent_name_2' => Yii::t('app', 'Parent Name 2'),
			'parent_email_2' => Yii::t('app', 'Parent Email 2'),
			'parent_name_emergency' => Yii::t('app', 'Parent Name Emergency'),
			'parent_phone_emergency' => Yii::t('app', 'Parent Phone Emergency'),
			'parent_cell_emergency' => Yii::t('app', 'Parent Cell Emergency'),
			'person_name_emergency' => Yii::t('app', 'Person Name Emergency'),
			'person_cell_emergency' => Yii::t('app', 'Person Cell Emergency'),
			'person_phone_emergency' => Yii::t('app', 'Person Phone Emergency'),
			'person_relation_to_student' => Yii::t('app', 'Person Relation To Student'),
			'physician_name' => Yii::t('app', 'Physician Name'),
			'physician_phone' => Yii::t('app', 'Physician Phone'),
			'dentist_name' => Yii::t('app', 'Dentist Name'),
			'dentist_phone' => Yii::t('app', 'Dentist Phone'),
			'food_alergies' => Yii::t('app', 'Food Alergies'),
			'medication_alergies' => Yii::t('app', 'Medication Alergies'),
			'medication_currently_taken' => Yii::t('app', 'Medication Currently Taken'),
			'last_tetanus_shot' => Yii::t('app', 'Last Tetanus Shot'),
			'submit_date' => Yii::t('app', 'Submit Date'),
			'order_id' => null,
			'enrollForm' => null,
			'order' => null,
		);
	}

	public function search() {

		$criteria = new CDbCriteria;

        if(!empty($this->filter_seminar)){
            $criteria->addCondition('t.order_id IN (
                SELECT orders.id
                FROM orders
                INNER JOIN student_seminars ON orders.id = student_seminars.order_id
                WHERE student_seminars.seminar_id = '. $this->filter_seminar .')
            ');
        }
        if(!empty($this->filter_grade)){
            $criteria->addCondition('t.order_id IN (
                SELECT orders.id
                FROM orders
                INNER JOIN student_seminars ON orders.id = student_seminars.order_id
                WHERE student_seminars.grade_id = '. $this->filter_grade .')
            ');
        }

        if(!empty($this->filter_timeSlot)){
            $criteria->addCondition('t.order_id IN (
                SELECT orders.id
                FROM orders
                INNER JOIN student_seminars ON orders.id = student_seminars.order_id
                INNER JOIN time_slot ON student_seminars.time_slot_id = time_slot.id
                WHERE time_slot.start_time >= "'. date('H:i:s', strtotime($this->filter_timeSlot["start_time"])) .'"
                AND time_slot.end_time <= "'. date('H:i:s', strtotime($this->filter_timeSlot["end_time"])) .'")
            ');
        }

        if(!empty($this->filter_datePeriod)){
            $criteria->addCondition('t.order_id IN (
                SELECT orders.id
                FROM orders
                INNER JOIN student_seminars ON orders.id = student_seminars.order_id
                INNER JOIN date_periods ON student_seminars.date_period_id = date_periods.id
                WHERE date_periods.start_date >= "'. $this->filter_datePeriod["start_date"] .'"
                AND date_periods.end_date <= "'. $this->filter_datePeriod["end_date"] .'")
            ');
        }

        if(!empty($this->payment_status)){
            $criteria->addCondition('t.order_id IN (
                SELECT orders.id
                FROM orders
                WHERE orders.payment_status = "'. $this->payment_status .'")
            ');
        }

		$criteria->compare('enroll_form_id', $this->enroll_form_id);
		$criteria->compare('student_name', $this->student_name, true);
		$criteria->compare('gender', $this->gender, true);
		$criteria->compare('current_school', $this->current_school, true);
		$criteria->compare('student_address', $this->student_address, true);
		$criteria->compare('student_home_phone', $this->student_home_phone, true);
		$criteria->compare('student_cell_phone', $this->student_cell_phone, true);
		$criteria->compare('student_email', $this->student_email, true);
		$criteria->compare('parent_name_1', $this->parent_name_1, true);
		$criteria->compare('parent_email_1', $this->parent_email_1, true);
		$criteria->compare('parent_name_2', $this->parent_name_2, true);
		$criteria->compare('parent_email_2', $this->parent_email_2, true);
		$criteria->compare('parent_name_emergency', $this->parent_name_emergency, true);
		$criteria->compare('parent_phone_emergency', $this->parent_phone_emergency, true);
		$criteria->compare('parent_cell_emergency', $this->parent_cell_emergency, true);
		$criteria->compare('person_name_emergency', $this->person_name_emergency, true);
		$criteria->compare('person_cell_emergency', $this->person_cell_emergency, true);
		$criteria->compare('person_phone_emergency', $this->person_phone_emergency, true);
		$criteria->compare('person_relation_to_student', $this->person_relation_to_student, true);
		$criteria->compare('physician_name', $this->physician_name, true);
		$criteria->compare('physician_phone', $this->physician_phone, true);
		$criteria->compare('dentist_name', $this->dentist_name, true);
		$criteria->compare('dentist_phone', $this->dentist_phone, true);
		$criteria->compare('food_alergies', $this->food_alergies, true);
		$criteria->compare('medication_alergies', $this->medication_alergies, true);
		$criteria->compare('medication_currently_taken', $this->medication_currently_taken, true);
		$criteria->compare('last_tetanus_shot', $this->last_tetanus_shot, true);
		$criteria->compare('submit_date', $this->submit_date, true);
		$criteria->compare('order_id', $this->order_id);


		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}