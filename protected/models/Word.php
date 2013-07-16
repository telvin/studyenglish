<?php

/**
 * This is the model class for table "word".
 *
 * The followings are the available columns in table 'word':
 * @property string $word_id
 * @property string $name
 * @property string $sound_file
 * @property integer $length
 * @property integer $type
 * @property string $meaning
 * @property string $priority
 * @property string $first_char
 * @property integer $word_count
 */
class Word extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Word the static model class
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
		return 'word';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('word_id', 'required'),
			array('length, type, word_count', 'numerical', 'integerOnly'=>true),
			array('word_id, priority', 'length', 'max'=>20),
			array('name, sound_file', 'length', 'max'=>255),
			array('first_char', 'length', 'max'=>1),
			array('meaning', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('word_id, name, sound_file, length, type, meaning, priority, first_char, word_count', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'word_id' => 'Word',
			'name' => 'Name',
			'sound_file' => 'Sound File',
			'length' => 'Length',
			'type' => 'Type',
			'meaning' => 'Meaning',
			'priority' => 'Priority',
			'first_char' => 'First Char',
			'word_count' => 'Word Count',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('word_id',$this->word_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('sound_file',$this->sound_file,true);
		$criteria->compare('length',$this->length);
		$criteria->compare('type',$this->type);
		$criteria->compare('meaning',$this->meaning,true);
		$criteria->compare('priority',$this->priority,true);
		$criteria->compare('first_char',$this->first_char,true);
		$criteria->compare('word_count',$this->word_count);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}