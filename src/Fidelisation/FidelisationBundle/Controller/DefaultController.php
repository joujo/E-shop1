<?php

namespace Fidelisation\FidelisationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FidelisationFidelisationBundle:Default:index.html.twig');
    }
}
