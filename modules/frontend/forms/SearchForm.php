<?php

namespace app\modules\frontend\forms;

use yii\base\Model;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\modules\frontend\forms
 */
class SearchForm extends Model
{
    /** @var string */
    public $query;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['query', 'required'],
            ['query', 'string', 'min' => 2, 'max' => 255],
        ];
    }
}
