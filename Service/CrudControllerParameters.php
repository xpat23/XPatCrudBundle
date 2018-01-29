<?php
/**
 * Created by PhpStorm.
 * User: xpat
 * Date: 26.01.18
 */

namespace XPat\CrudBundle\Service;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use XPat\CrudBundle\Classes\CreateConfiguration;
use XPat\CrudBundle\Classes\ListConfiguration;
use XPat\CrudBundle\Classes\ShowConfiguration;
use XPat\CrudBundle\Classes\UpdateConfiguration;
use XPat\CrudBundle\Form\CrudType;

class CrudControllerParameters
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var string
     */
    protected $routePrefix;

    /**
     * @var ListConfiguration
     */
    protected $listConfig;

    /**
     * @var CreateConfiguration
     */
    protected $createConfig;

    /**
     * @var UpdateConfiguration
     */
    protected $updateConfig;

    /**
     * @var ShowConfiguration
     */
    protected $showConfig;

    /**
     * @var string
     */
    protected $formType;


    /**
     * @var string
     */
    protected $title;


    public function __construct(RequestStack $requestStack)
    {
        $this->request = $requestStack->getCurrentRequest();

        $this->listConfig = new ListConfiguration($this);

        $this->createConfig = new CreateConfiguration($this);

        $this->updateConfig = new UpdateConfiguration($this);

        $this->showConfig = new ShowConfiguration($this);

        $this->formType = CrudType::class;

        $this->createConfig->setTemplate("@XPatCrud/Crud/new.html.twig");

        $this->listConfig->setTemplate("@XPatCrud/Crud/index.html.twig");

        $this->updateConfig->setTemplate("@XPatCrud/Crud/edit.html.twig");

        $this->showConfig->setTemplate("@XPatCrud/Crud/show.html.twig");

        $this->routePrefix = str_replace(["_index","_new","_edit","_show","_delete"],"",$this->request->attributes->get("_route"))."_";
    }

    /**
     * @return string
     */
    public function getRoutePrefix(){
        return $this->routePrefix;
    }

    /**
     * @param string $routePrefix
     */
    public function setRoutePrefix($routePrefix)
    {
        $this->routePrefix = $routePrefix;
    }

    /**
     * @return ListConfiguration
     */
    public function getListConfig()
    {
        return $this->listConfig;
    }

    /**
     * @param ListConfiguration $listConfig
     */
    public function setListConfig($listConfig)
    {
        $this->listConfig = $listConfig;
    }

    /**
     * @return CreateConfiguration
     */
    public function getCreateConfig()
    {
        return $this->createConfig;
    }

    /**
     * @param CreateConfiguration $createConfig
     */
    public function setCreateConfig($createConfig)
    {
        $this->createConfig = $createConfig;
    }

    /**
     * @return UpdateConfiguration
     */
    public function getUpdateConfig()
    {
        return $this->updateConfig;
    }

    /**
     * @param UpdateConfiguration $updateConfig
     */
    public function setUpdateConfig($updateConfig)
    {
        $this->updateConfig = $updateConfig;
    }

    /**
     * @return ShowConfiguration
     */
    public function getShowConfig()
    {
        return $this->showConfig;
    }

    /**
     * @param ShowConfiguration $showConfig
     */
    public function setShowConfig($showConfig)
    {
        $this->showConfig = $showConfig;
    }



    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getFormType()
    {
        return $this->formType;
    }

    /**
     * @param string $formType
     */
    public function setFormType($formType)
    {
        $this->formType = $formType;
    }





}