<?php

namespace Models;

class School extends \Phalcon\Mvc\Model
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
    public $school_id;

    /**
     *
     * @var integer
     */
    public $division_id;

    /**
     *
     * @var integer
     */
    public $school_district_id;

    /**
     *
     * @var integer
     */
    public $barangay_id;

    /**
     *
     * @var string
     */
    public $school_name;

    /**
     *
     * @var string
     */
    public $school_short_name;

    /**
     *
     * @var string
     */
    public $school_previous_name;

    /**
     *
     * @var integer
     */
    public $has_kinder;

    /**
     *
     * @var integer
     */
    public $has_elem;

    /**
     *
     * @var integer
     */
    public $has_jhs;

    /**
     *
     * @var integer
     */
    public $has_shs;

    /**
     *
     * @var string
     */
    public $school_head;

    /**
     *
     * @var string
     */
    public $school_head_position;

    /**
     *
     * @var string
     */
    public $telephone_no;

    /**
     *
     * @var string
     */
    public $mobile_no;

    /**
     *
     * @var string
     */
    public $fax_no;

    /**
     *
     * @var string
     */
    public $website;

    /**
     *
     * @var string
     */
    public $email_address;

    /**
     *
     * @var integer
     */
    public $date_established;

    /**
     *
     * @var integer
     */
    public $is_central_school;

    /**
     *
     * @var integer
     */
    public $is_annex_extension_school;

    /**
     *
     * @var integer
     */
    public $is_extension_mother_school_id;

    /**
     *
     * @var integer
     */
    public $is_implementing_unit;

    /**
     *
     * @var integer
     */
    public $sector_id;

    /**
     *
     * @var integer
     */
    public $is_deleted;

    /**
     *
     * @var string
     */
    public $deleted_date;

    /**
     *
     * @var integer
     */
    public $deleted_by;

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
     *
     * @var string
     */
    public $closed_date;

    /**
     *
     * @var integer
     */
    public $closed_by;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setConnectionService('db_beis'); // Explicity define the db connection used since working with multiple.
        $this->setSchema("beis");
        $this->setSource("school");
        $this->hasMany('id', 'Models\SchoolProfiles', 'school_id', ['alias' => 'SchoolProfiles']);
        $this->belongsTo('barangay_id', 'Models\Barangay', 'id', ['alias' => 'Barangay']);
        $this->belongsTo('division_id', 'Models\Division', 'id', ['alias' => 'Division']);
        $this->belongsTo('school_district_id', 'Models\SchoolDistrict', 'id', ['alias' => 'SchoolDistrict']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'school';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return School[]|School|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return School|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
