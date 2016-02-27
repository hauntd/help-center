<?php

namespace app\forms;

use yii\base\Model;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\forms
 */
class CategorySortForm extends Model
{
    /**
     * Position
     */
    const AFTER = 'after';
    const BEFORE = 'before';
    const INSIDE = 'inside';

    /**
     * Type
     */
    const TYPE_ONLY_MOVE = 'onlyMove';
    const TYPE_SET_PARENT_AND_MOVE = 'setParentAndMove';

    /**
     * Sort direction
     */
    const MOVE_UP = 'moveUp';
    const MOVE_DOWN = 'moveDown';

    /** @var integer */
    public $movedNodeId;

    /** @var integer */
    public $movedNodeParentId;

    /** @var integer */
    public $targetNodeId;

    /** @var integer */
    public $targetNodeParentId;

    /** @var integer */
    public $newParentId;

    /** @var string */
    public $position;

    /** @var string */
    public $type;

    /** @var string */
    public $moveTo;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['movedNodeId', 'targetNodeId', 'position'], 'required'],
            [['movedNodeId', 'targetNodeId', 'movedNodeParentId', 'targetNodeParentId', 'newParentId'], 'integer'],
            ['position', 'in', 'range' => [self::AFTER, self::BEFORE, self::INSIDE]],
            ['type', 'in', 'range' => [self::TYPE_ONLY_MOVE, self::TYPE_SET_PARENT_AND_MOVE]],
            ['moveTo', 'in', 'range' => [self::MOVE_UP, self::MOVE_DOWN]],
        ];
    }
}
