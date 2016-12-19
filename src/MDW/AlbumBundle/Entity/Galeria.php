<?php

namespace MDW\AlbumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Galeria
 *
 * @ORM\Table(name="galeria")
 * @ORM\Entity(repositoryClass="MDW\AlbumBundle\Repository\GaleriaRepository")
 */
class Galeria
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="visibilidad", type="string", length=255)
     */
    private $visibilidad;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
      * @ORM\OneToOne(targetEntity="\MDW\RegisterBundle\Entity\User", inversedBy="galeria")
      * @ORM\JoinColumn(name="propietario", referencedColumnName="id",onDelete="CASCADE")
      * @return integer
    */
    private $propietario;
    public function setPropietario(\MDW\RegisterBundle\Entity\User $user)
    {
      $this->propietario = $user;
    }

    public function getUser()
    {
      return $this->propietario;
    }

    /**
     * Get propietario
     *
     * @return \MDW\RegisterBundle\Entity\User
     */
    public function getPropietario()
    {
        return $this->propietario;
    }

    /**
      * @ORM\OneToMany(targetEntity="Imagen", mappedBy="galeria")
    */
    private $imagenes;

    public function __construct()
    {
      $this->visibilidad = 'Private';
      $this->imagenes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function addImagenes(\MDW\AlbumBundle\Entity\Imagen $imagenes)
    {
      $this->imagenes[] = $imagenes;
    }

    public function getImagenes()
    {
      return $this->imagenes;
    }

    /**
     * Add imagen
     *
     * @param \MDW\AlbumBundle\Entity\Imagen $imagen
     *
     * @return Galeria
     */
    public function addImagen(\MDW\AlbumBundle\Entity\Imagen $imagen)
    {
        $this->imagenes[] = $imagen;

        return $this;
    }

    /**
     * Remove imagen
     *
     * @param \MDW\AlbumBundle\Entity\Imagen $imagen
     */
    public function removeImagen(\MDW\AlbumBundle\Entity\Imagen $imagen)
    {
        $this->imagenes->removeElement($imagen);
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Galeria
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set visibilidad
     *
     * @param string $visibilidad
     *
     * @return Galeria
     */
    public function setVisibilidad($visibilidad)
    {
        $this->visibilidad = $visibilidad;

        return $this;
    }

    /**
     * Get visibilidad
     *
     * @return string
     */
    public function getVisibilidad()
    {
        return $this->visibilidad;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Galeria
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}
