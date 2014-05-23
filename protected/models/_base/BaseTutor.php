<?php

/**
 * This is the model base class for the table "tutors".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Tutor".
 *
 * Columns in table "tutors" available as properties of the model,
 * followed by relations of table "tutors" available as properties of the model.
 *
 * @property string $id
 * @property string $name
 * @property string $subjects
 * @property string $experience
 * @property string $education
 * @property string $big_image
 * @property string $small_image
 * @property integer $active
 *
 * @property TutorStudents[] $tutorStudents
 * @property TutorsDaysTimes[] $tutorsDaysTimes
 */
abstract class BaseTutor extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tutors';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Tutor|Tutors', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('name', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('name, subjects, education', 'length', 'max'=>255),
			array('experience', 'safe'),
			array('subjects, experience, education, active', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, name, subjects, experience, education, active', 'safe', 'on'=>'search'),
            array('big_image, small_image', 'file', 'allowEmpty' => true, 'types'=>'jpg, png'),
		);
	}

	public function relations() {
		return array(
			'tutorStudents' => array(self::HAS_MANY, 'TutorStudents', 'tutors_id'),
			'tutorsDaysTimes' => array(self::HAS_MANY, 'TutorDayTime', 'tutors_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'name' => Yii::t('app', 'Name'),
			'subjects' => Yii::t('app', 'Subjects'),
			'experience' => Yii::t('app', 'Experience'),
			'education' => Yii::t('app', 'Education'),
			'active' => Yii::t('app', 'Active'),
            'big_image' => Yii::t('app', 'Big Image'),
			'tutorStudents' => null,
			'tutorsDaysTimes' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('subjects', $this->subjects, true);
		$criteria->compare('experience', $this->experience, true);
		$criteria->compare('education', $this->education, true);
//		$criteria->compare('active', $this->active);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

    public function afterValidate()
    {
        $uploadPath = Yii::getPathOfAlias('webroot') . '/uploads/tutors_img/';

        if(!empty($this->big_image) && empty($this->errors)) {

            $imagePath = uniqid('tutor-img-', false) . '.' . $this->big_image->getExtensionName();

            if($this->big_image->saveAs($uploadPath . $imagePath)) {
                $this->big_image = $imagePath;
            }
        }

        if(!empty($this->small_image) && empty($this->errors)) {

            $imagePath = uniqid('tutor-img-', false) . '.' . $this->small_image->getExtensionName();

            if($this->small_image->saveAs($uploadPath . $imagePath)) {
                $this->small_image = $imagePath;
            }
        }
    }
}