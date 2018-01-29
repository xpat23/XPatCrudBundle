<?php
/**
 * Created by PhpStorm.
 * User: xpat
 * Date: 26.01.18
 */

namespace XPat\CrudBundle\Classes;


use XPat\CrudBundle\Service\CrudControllerParameters;

abstract class BaseConfiguration
{
    /**
     * @var string
     */
    protected $template;

    /**
     * @var CrudControllerParameters
     */
    protected $parameters;
    /**
     * @var array
     */
    protected $scripts = [];

    /**
     * @var array
     */
    protected $styles = [];

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param string $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }

    public function __construct(CrudControllerParameters $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @return CrudControllerParameters
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param CrudControllerParameters $parameters
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @return array
     */
    public function getScripts()
    {
        return $this->scripts;
    }

    /**
     * @param array $scripts
     */
    public function setScripts($scripts)
    {
        $this->scripts = $scripts;
    }

    /**
     * @return array
     */
    public function getStyles()
    {
        return $this->styles;
    }

    /**
     * @param array $styles
     */
    public function setStyles($styles)
    {
        $this->styles = $styles;
    }

    /**
     * @param $src
     */
    public function addScript($src){
        $this->scripts[] = $src;
    }

    /**
     * @param $src
     */
    public function addStyle($src){
        $this->styles[] = $src;
    }



}