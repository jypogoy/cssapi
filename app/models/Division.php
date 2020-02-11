<?php

namespace Models;

class Division extends \Phalcon\Mvc\Model
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
    public $region_id;

    /**
     *
     * @var string
     */
    public $division_name;

    /**
     *
     * @var string
     */
    public $address;

    /**
     *
     * @var string
     */
    public $telephone_no;

    /**
     *
     * @var string
     */
    public $fax_no;

    /**
     *
     * @var string
     */
    public $email_address;

    /**
     *
     * @var string
     */
    public $website;

    /**
     *
     * @var string
     */
    public $head;

    /**
     *
     * @var string
     */
    public $head_position;

    /**
     *
     * @var string
     */
    public $created_date;

    /**
     *
     * @var integer
     */
    public $created_by;

    /**
     *
     * @var string
     */
    public $modified_date;

    /**
     *
     * @var integer
     */
    public $modified_by;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setConnectionService('db_beis'); // Explicity define the db connection used since working with multiple.
        $this->setSchema("beis");
        $this->setSource("division");
        $this->hasMany('id', 'School', 'division_id', ['alias' => 'School']);
        $this->hasMany('id', 'SchoolDistrict', 'division_id', ['alias' => 'SchoolDistrict']);
        $this->belongsTo('region_id', 'Region', 'id', ['alias' => 'Region']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'division';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Division[]|Division|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Division|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
