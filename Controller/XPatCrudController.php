<?php

namespace XPat\CrudBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use XPat\CrudBundle\Classes\CreateConfiguration;
use XPat\CrudBundle\Classes\ListConfiguration;
use XPat\CrudBundle\Classes\ShowConfiguration;
use XPat\CrudBundle\Classes\UpdateConfiguration;
use XPat\CrudBundle\Service\CrudControllerParameters;

abstract class XPatCrudController extends Controller
{
    /**
     * @var CrudControllerParameters
     */
    private $controllerParameters;

    /**
     * @return CrudControllerParameters
     */
    public function getControllerParameters()
    {
        return $this->controllerParameters;
    }

    /**
     * Entity class name
     * @return string
     */
    protected abstract function getEntity();

    /**
     * @param CrudControllerParameters $controllerParameters
     */
    public function setControllerParameters($controllerParameters)
    {
        $this->controllerParameters = $controllerParameters;
    }

    /**
     * @Route("/")
     */
    public function indexAction(Request $request)
    {
        $this->init();

        $config = $this->getControllerParameters()->getListConfig();

        $this->listConfiguration($config);

        $entities = $this->getDoctrine()->getRepository($this->getEntity())
            ->findAll();

        return $this->render($config->getTemplate(),[
            'entities' => $entities,
            'params' => $this->getControllerParameters()
        ]);
    }

    /**
     * @param ListConfiguration $configuration
     */
    protected function listConfiguration(ListConfiguration $configuration){
        $configuration->addField('id','id');
    }
    //--------------------------

    // show action

    /**
     * @Route("/show/{id}")
     * @throws \Exception
     */
    public function showAction(Request $request, $id)
    {

        $entity = $this->getDoctrine()->getRepository($this->getEntity())->find($id);

        if(!$entity){
            throw new \Exception("Entity not found");
        }

        $this->init();

        $config = $this->getControllerParameters()->getShowConfig();

        $this->showConfiguration($config);

        return $this->render($config->getTemplate(),[
            'entity' => $entity,
            'params' => $this->getControllerParameters()
        ]);
    }

    /**
     * @param ShowConfiguration $configuration
     */
    protected function showConfiguration(ShowConfiguration $configuration){
        $configuration->addField("id","id");
    }
    // -----------------------

    //create

    /**
     * @Route("/new")
     */
    public function newAction(Request $request)
    {
        $this->init();

        $entityClass = $this->getEntity();

        $entity = new $entityClass();

        $config = $this->getControllerParameters()->getCreateConfig();

        $this->createConfiguration($config,$entity, $request);

        $form = $this->createForm($this->getControllerParameters()->getFormType(),$entity);

        $config->setForm($form);

        $form->handleRequest($request);

        if($form->isSubmitted() and $form->isValid()){

            $this->beforeCreate($entity,$request);

            $em = $this->getDoctrine()->getManager();

            $em->persist($entity);

            $em->flush();

            return $this->redirectToRoute($this->getControllerParameters()->getRoutePrefix()."index");
        }

        return $this->render($config->getTemplate(),[
            'form' => $form->createView(),
            'params' => $this->getControllerParameters()
        ]);
    }

    /**
     * @param CreateConfiguration $configuration
     * @param $entity
     */
    protected function createConfiguration(CreateConfiguration $configuration, $entity, Request $request){}


    protected function beforeCreate($entity,Request $request){}

    //--------------------

    //update

    /**
     * @Route("/edit/{id}")
     * @throws \Exception
     */
    public function editAction(Request $request,$id)
    {

        $entity = $this->getDoctrine()->getRepository($this->getEntity())->find($id);

        if(!$entity){
            throw new \Exception("Entity not found");
        }

        $this->init();

        $config = $this->getControllerParameters()->getUpdateConfig();

        $form = $this->createForm($this->getControllerParameters()->getFormType(),$entity);

        $config->setForm($form);

        $this->updateConfiguration($config,$entity, $request);

        $form->handleRequest($request);

        if($form->isSubmitted() and $form->isValid()){

            $this->beforeUpdate($entity,$request);

            $em = $this->getDoctrine()->getManager();

            $em->persist($entity);

            $em->flush();

            return $this->redirectToRoute($this->getControllerParameters()->getRoutePrefix()."index");
        }

        return $this->render($config->getTemplate(),[
            'form' => $form->createView(),
            'params' => $this->getControllerParameters()
        ]);
    }

    /**
     * @param UpdateConfiguration $configuration
     * @param $entity
     * @param Request $request
     */
    protected function updateConfiguration(UpdateConfiguration $configuration, $entity, Request $request){
        //
    }

    protected function beforeUpdate($entity,Request $request){}

    //---------------------

    //delete
    /**
     * @Route("/delete/{id}")
     * @throws \Exception
     */
    public function deleteAction(Request $request,$id)
    {
        $entity = $this->getDoctrine()->getRepository($this->getEntity())->find($id);

        if(!$entity){
            throw new \Exception("Entity not found");
        }

        $this->init();

        $em = $this->getDoctrine()->getManager();

        $this->beforeDelete($entity,$request);

        $em->remove($entity);

        $em->flush();

        return $this->redirectToRoute($this->getControllerParameters()->getRoutePrefix()."index");

    }

    /**
     * @param $entity
     * @param Request $request
     */
    protected function beforeDelete($entity,Request $request){}

    // --------------------


    //global config
    /**
     *
     */
    protected function init(){
        $params = $this->get('x_pat_crud.controller_params');
        $this->configure($params);
        $this->setControllerParameters($params);
    }

    /**
     * @param CrudControllerParameters $parameters
     */
    protected function configure(CrudControllerParameters $parameters){
//        $parameters->setTitle("Title");
    }


}
