<?php

namespace Binaerpiloten\MagicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BinaerpilotenMagicBundle::index.html.twig');
    }
}
