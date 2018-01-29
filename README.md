# XPatCrudBundle

Installation
------------

Use Composer for the automated process:

```bash
 composer require xpat/crud-bundle
```

### Adding bundle to your application kernel

```php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new XPat\CrudBundle\XPatCrudBundle(),
        // ...
    );
}
```

Usage
-----

Entity:

```php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity()
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $name;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    
}
```


Controller:

```php
<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Category;
use AppBundle\Form\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use XPat\CrudBundle\Classes\ListConfiguration;
use XPat\CrudBundle\Controller\XPatCrudController;
use XPat\CrudBundle\Service\CrudControllerParameters;

/**
 * Class CategoryController
 * @package AppBundle\Controller
 * @Route("/category")
 */
class CategoryController extends XPatCrudController
{

    /**
     * Entity class name
     * @return string
     */
    protected function getEntity()
    {
        return Category::class;
    }


    /**
     * @param ListConfiguration $configuration
     */
    protected function listConfiguration(ListConfiguration $configuration){
        $configuration
            ->addField('id','id')
            ->addField("name","name");
    }

    /**
     * @param CrudControllerParameters $parameters
     */
    protected function configure(CrudControllerParameters $parameters)
    {
       $parameters->setTitle("Category");
       
       $parameters->setFormType(CategoryType::class);
    }
}
```
