<?php

/**
 * This is the model class for table "payments".
 *
 * The followings are the available columns in table 'payments':
 * @property integer $id
 * @property integer $user_id
 * @property float $amount
 * @property string $email
 * @property string $name
 * @property string $details
 * @property string $state
 * @property integer $user_seminar_id
 */
class Seminar extends CActiveRecord
{
    const STATE_PENDING = 'pending';
    const STATE_CANCELED = 'canceled';
    const STATE_COMPLETED = 'completed';
    const STATE_FAIL = 'fail';

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
		return 'payments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('user_id, amount, email, name, details, state, user_seminar_id', 'required'),
            array('email, name', 'length', 'max' => 255),
            array('amount', 'numeric',),
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
            'user_seminar'=>array(self::BELONGS_TO, 'UserSeminar', 'user_seminar_id'),
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	/*public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
            'price' => 'Price',
            'favourite' => 'Favourite',
            'active' => 'Active',
            'type' => 'Type',

		);
	}*/

}