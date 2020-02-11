<?php

namespace Models;

class Region extends \Phalcon\Mvc\Model
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
    public $rank;

    /**
     *
     * @var string
     */
    public $psgc_region_code;

    /**
     *
     * @var string
     */
    public $region_name;

    /**
     *
     * @var string
     */
    public $region_short_name;

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
     * @var integer
     */
    public $is_active;

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
        $this->setSource("region");
        $this->hasMany('id', 'Models\Division', 'region_id', ['alias' => 'Division']);
        $this->hasMany('id', 'Models\Province', 'region_id', ['alias' => 'Province']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'region';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Region[]|Region|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Region|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
