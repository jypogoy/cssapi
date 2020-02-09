<?php

namespace Models;

class Mov extends \Phalcon\Mvc\Model
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
    public $indicator_id;

    /**
     *
     * @var integer
     */
    public $school_profiles_id;

    /**
     *
     * @var string
     */
    public $file_name;

    /**
     *
     * @var string
     */
    public $file_type;

    /**
     *
     * @var string
     */
    public $url;

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
        $this->setSource("mov");
        $this->belongsTo('indicator_id', 'Indicator', 'id', ['alias' => 'Indicator']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'mov';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Mov[]|Mov|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Mov|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
