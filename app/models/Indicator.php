<?php

namespace Models;

class Indicator extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $parent_id;

    /**
     *
     * @var integer
     */
    public $area_id;

    /**
     *
     * @var string
     */
    public $indicator;

    /**
     *
     * @var string
     */
    public $description;

    /**
     *
     * @var string
     */
    public $answer_table;

    /**
     *
     * @var string
     */
    public $answer_field;

    /**
     *
     * @var string
     */
    public $primary_field;

    /**
     *
     * @var string
     */
    public $alt_field;

    /**
     *
     * @var string
     */
    public $type;

    /**
     *
     * @var string
     */
    public $created_at;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("css");
        $this->setSource("indicator");
        $this->hasMany('id', 'Indicator', 'parent_id', ['alias' => 'Indicator']);
        $this->hasMany('id', 'Mov', 'indicator_id', ['alias' => 'Mov']);
        $this->belongsTo('area_id', 'Area', 'id', ['alias' => 'Area']);
        $this->belongsTo('parent_id', 'Indicator', 'id', ['alias' => 'Indicator']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'indicator';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Indicator[]|Indicator|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Indicator|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
