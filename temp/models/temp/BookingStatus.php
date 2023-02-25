<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "booking_status".
 *
 * @property int $id Идентификатор
 * @property string $title Название
 *
 * @property Booking[] $bookings
 */
class BookingStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'booking_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['id_booking_status' => 'id']);
    }
}
