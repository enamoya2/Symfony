<?php

namespace MDW\AlbumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AlbumBundle:Default:index.html.twig');
    }
}
