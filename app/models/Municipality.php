<?php

namespace Models;

class Municipality extends \Phalcon\Mvc\Model
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
    public $province_id;

    /**
     *
     * @var string
     */
    public $psgc_municipal_code;

    /**
     *
     * @var string
     */
    public $municipality_name;

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
        $this->setSource("municipality");
        $this->hasMany('id', 'Models\Barangay', 'municipality_id', ['alias' => 'Barangay']);
        $this->belongsTo('province_id', 'Models\Province', 'id', ['alias' => 'Province']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'municipality';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Municipality[]|Municipality|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Municipality|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
