<?php
/**
 * Created by PhpStorm.
 * User: xpat
 * Date: 26.01.18
 */

namespace XPat\CrudBundle\Classes;


use Symfony\Component\Form\FormInterface;

class CreateConfiguration extends BaseConfiguration
{
    /**
     * @var FormInterface
     */
    protected $form;

    /**
     * @return FormInterface
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param FormInterface $form
     */
    public function setForm($form)
    {
        $this->form = $form;
    }



}