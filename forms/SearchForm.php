<?php

namespace app\forms;

use yii\base\Model;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\forms
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
