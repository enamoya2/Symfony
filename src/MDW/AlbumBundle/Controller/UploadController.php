<?php

namespace MDW\AlbumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MDW\AlbumBundle\Entity\Imagen;
use MDW\AlbumBundle\Entity\Galeria;
use MDW\RegisterBundle\Entity\User;
use MDW\AlbumBundle\Form\ImagenType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class UploadController extends Controller
{
  /**
    * @Template()
  */
  public function uploadAction()
  {
    $request = $this->getRequest();
    $imagen = new Imagen();
    $form = $this->createForm(new ImagenType(), $imagen);

    if ($request->getMethod() == 'POST')
    {
      $form->handleRequest($request);
      if ($form->isValid())
      {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $imagen->setGaleria($user->getGaleria());
        $imagen->upload();
        $em->persist($imagen);
        $em->flush();
        //return $this->redirect($this->generateUrl(...));
        return $this->render('MDWRegisterBundle:Default:message.html.twig', array('message' => "Foto subida correctamente"));
      }
    }
    return $this->render(
      'AlbumBundle:Default:upload.html.twig',
      array('form' => $form->createView())
      );
  }
}
