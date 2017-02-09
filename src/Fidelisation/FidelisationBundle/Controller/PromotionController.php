<?php

namespace Fidelisation\FidelisationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PromotionController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
}
