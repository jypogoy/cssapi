<?php

namespace Models;

class Barangay extends \Phalcon\Mvc\Model
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
    public $municipality_id;

    /**
     *
     * @var string
     */
    public $psgc_barangay_code;

    /**
     *
     * @var string
     */
    public $barangay_name;

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
        $this->setSource("barangay");
        $this->hasMany('id', 'Models\School', 'barangay_id', ['alias' => 'School']);
        $this->belongsTo('municipality_id', 'Models\Municipality', 'id', ['alias' => 'Municipality']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'barangay';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Barangay[]|Barangay|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Barangay|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
