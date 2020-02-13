<?php

namespace Models;

class SchoolProfiles extends \Phalcon\Mvc\Model
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
    public $school_year_id;

    /**
     *
     * @var integer
     */
    public $school_profile_type_id;

    /**
     *
     * @var string
     */
    public $profile;

    /**
     *
     * @var integer
     */
    public $validated;

    /**
     *
     * @var string
     */
    public $validation_date;

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
    public $deleted_date;

    /**
     *
     * @var integer
     */
    public $deleted_by;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setConnectionService('db_beis'); // Explicity define the db connection used since working with multiple.
        $this->setSchema("beis");
        $this->setSource("school_profiles");
        $this->hasMany('id', 'EsArmedconflictRelInitiatives', 'school_profiles_id', ['alias' => 'EsArmedconflictRelInitiatives']);
        $this->hasMany('id', 'EsConflictBymonth', 'school_profiles_id', ['alias' => 'EsConflictBymonth']);
        $this->hasMany('id', 'EsDisaster', 'school_profiles_id', ['alias' => 'EsDisaster']);
        $this->hasMany('id', 'EsDisasterResult', 'school_profiles_id', ['alias' => 'EsDisasterResult']);
        $this->hasMany('id', 'EsDisasterRisk', 'school_profiles_id', ['alias' => 'EsDisasterRisk']);
        $this->hasMany('id', 'EsDisasterRiskEducation', 'school_profiles_id', ['alias' => 'EsDisasterRiskEducation']);
        $this->hasMany('id', 'EsDisasterRiskReductionDisaster', 'school_profiles_id', ['alias' => 'EsDisasterRiskReductionDisaster']);
        $this->hasMany('id', 'EsDisasterRiskTrainings', 'school_profiles_id', ['alias' => 'EsDisasterRiskTrainings']);
        $this->hasMany('id', 'EsEnablingEnvironment', 'school_profiles_id', ['alias' => 'EsEnablingEnvironment']);
        $this->hasMany('id', 'EsSafeLearning', 'school_profiles_id', ['alias' => 'EsSafeLearning']);
        $this->hasMany('id', 'EsSchoolProfile', 'school_profiles_id', ['alias' => 'EsSchoolProfile']);
        $this->hasMany('id', 'JhsDisasterRisk', 'school_profiles_id', ['alias' => 'JhsDisasterRisk']);
        $this->hasMany('id', 'JhsEnablingEnvironment', 'school_profiles_id', ['alias' => 'JhsEnablingEnvironment']);
        $this->hasMany('id', 'JhsSafeLearning', 'school_profiles_id', ['alias' => 'JhsSafeLearning']);
        $this->hasMany('id', 'ShsDisasterPreparednes', 'school_profiles_id', ['alias' => 'ShsDisasterPreparednes']);
        $this->hasMany('id', 'ShsEnablingEnvironment', 'school_profiles_id', ['alias' => 'ShsEnablingEnvironment']);
        $this->hasMany('id', 'ShsSafeLearning', 'school_profiles_id', ['alias' => 'ShsSafeLearning']);
        $this->belongsTo('school_id', 'School', 'id', ['alias' => 'School']);
        $this->belongsTo('school_profile_type_id', 'SchoolProfileType', 'id', ['alias' => 'SchoolProfileType']);
        $this->belongsTo('school_year_id', 'SchoolYear', 'id', ['alias' => 'SchoolYear']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'school_profiles';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SchoolProfiles[]|SchoolProfiles|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SchoolProfiles|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
