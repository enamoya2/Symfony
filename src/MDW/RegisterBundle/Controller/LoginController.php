<?php

namespace MDW\RegisterBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LoginController extends Controller
{
  /**
  * @Route("/login", name="login_route")
  */
  public function loginAction(Request $request)
  {
    $authenticationUtils = $this->get('security.authentication_utils');
    $error = $authenticationUtils->getLastAuthenticationError();
    $lastUsername = $authenticationUtils->getLastUsername();

    return $this->render(
    'MDWRegisterBundle:Default:login.html.twig',
    array(
      'last_username' => $lastUsername,
      'error'         => $error,
    )
  );
}

/**
* @Route("/login_check", name="login_check")
*/
public function loginCheckAction()
{
}
}
