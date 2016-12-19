<?php

namespace MDW\RegisterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MDWRegisterBundle:Default:index.html.twig');
    }

    public function messageAction($message)
    {
        return $this->render('MDWRegisterBundle:Default:message.html.twig', array('message' => $message));
    }
    public function adminAction()
    {

    //$users = $this->getDoctrine()
    //->getRepository('AdrianGRegisterBundle:User')
    //->findby(array('roles' => 'ROLE_USER' ));

    return $this->render('MDWRegisterBundle:Default:admin.html.twig');
    }
}
