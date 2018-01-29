<?php
/**
 * Created by PhpStorm.
 * User: xpat
 * Date: 26.01.18
 */

namespace XPat\CrudBundle\Classes;


use XPat\CrudBundle\Service\CrudControllerParameters;

class ListConfiguration extends BaseConfiguration
{
    /**
     * @var HashMap
     */
    protected $fields;



    /**
     * ListConfiguration constructor.
     */
    public function __construct(CrudControllerParameters $parameters)
    {
        parent::__construct($parameters);

        $this->fields = new HashMap();
    }

    /**
     * @param $field string
     * @param $label string
     * @return $this
     */
    public function addField($field,$label){
        $this->fields->put($field,$label);
        return $this;
    }

    /**
     * @return HashMap
     */
    public function getFields()
    {
        return $this->fields;
    }

}