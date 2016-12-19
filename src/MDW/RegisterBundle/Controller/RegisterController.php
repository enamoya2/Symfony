<?php

namespace MDW\RegisterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MDW\RegisterBundle\Form\UserType;
use MDW\RegisterBundle\Entity\User;
use MDW\AlbumBundle\Entity\Galeria;

class RegisterController extends Controller
{
  public function registerAction()
  {
    $request = $this->getRequest();

    $user = new User();
    $form = $this->createForm(new UserType(), $user);
    $ds = DIRECTORY_SEPARATOR;
    if($request->getMethod() == 'POST')
    {
      $form->handleRequest($request);
      if($form->isValid())
      {
        $alreadyEmail = $this->getDoctrine()
        ->getRepository('MDWRegisterBundle:user')
        ->findOneByemail($user->getEmail());
        if ($alreadyEmail != null){
          return $this->render('MDWRegisterBundle:Default:message.html.twig', array('message' => "Ese email ya existe"));
        }
        $alreadyName = $this->getDoctrine()
        ->getRepository('MDWRegisterBundle:user')
        ->findOneByUsername($user->getUsername());
        if ($alreadyName != null){
          return $this->render('MDWRegisterBundle:Default:message.html.twig', array('message' => "Ya existe un usuario con ese nombre"));
        }

        $password = $this->get('security.password_encoder')
        ->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password);
        $galeria = new Galeria();
        $galeria->setNombre("Default");
        $galeria->setVisibilidad("Publica");
        $newDirPath = 'uploads'. $ds .$user->getUsername(). $ds .$galeria->getNombre();
        if (!file_exists($newDirPath)) {
          mkdir($newDirPath, 0777, true);
        }
        $pathgal = 'uploads'. $ds .$user->getUserName();
        $galeria->setPath($pathgal);
        $galeria->setPropietario($user);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->persist($galeria);
        $em->flush();

        return $this->render('MDWRegisterBundle:Default:message.html.twig', array('message' => "Usuario registrado correctamente"));
      }
    }
    return $this->render(
      'MDWRegisterBundle:Default:register.html.twig',
      array('form' => $form->createView())
      );
  }
}
