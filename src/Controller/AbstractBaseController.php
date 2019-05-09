<?php

namespace App\Controller;


use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\AbstractFOSRestController;

class AbstractBaseController extends AbstractFOSRestController
{

    public function getResponse($object, $statusCode = 200, $serializerGroups = ['Default'])
    {
        $context = new Context();
        $context->setGroups($serializerGroups);

        $view = $this->view($object, $statusCode);
        $view->setContext($context);

        return $this->handleView($view);
    }
}
