<?php

namespace MDW\AlbumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etiqueta
 *
 * @ORM\Table(name="etiqueta")
 * @ORM\Entity(repositoryClass="MDW\AlbumBundle\Repository\EtiquetaRepository")
 */
class Etiqueta
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
     * @ORM\Column(name="etiqueta", type="string", length=255)
     */
    private $etiqueta;


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
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return Etiqueta
     */
    public function setEtiqueta($etiqueta)
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }

    /**
     * Get etiqueta
     *
     * @return string
     */
    public function getEtiqueta()
    {
        return $this->etiqueta;
    }

    /**
     * @ORM\ManyToMany(targetEntity="Imagen" ,  inversedBy="etiquetas_imagenes")
     * @ORM\JoinTable(name="etiquetas_imagenes",
     *      joinColumns={@ORM\JoinColumn(name="etiqueta_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="imagen_id", referencedColumnName="id")}
     *      )
    */
    private $etiquetas_imagenes;

    /**
     * Add etiquetasImagen
     *
     * @param \MDW\AlbumBundle\Entity\Imagen $etiquetasImagen
     *
     * @return Etiqueta
    */
    public function addEtiquetasImagen(\MDW\AlbumBundle\Entity\Imagen $etiquetasImagen)
    {
        $this->etiquetas_imagenes[] = $etiquetasImagen;
        return $this;
    }

    /**
     * Remove etiquetasImagen
     *
     * @param \MDW\AlbumBundle\Entity\Imagen $etiquetasImagen
    */
    public function removeEgtiquetasImagen(\MDW\AlbumBundle\Entity\Imagen $etiquetasImagen)
    {
        $this->etiquetas_imagenes->removeElement($etiquetasImagen);
    }

    /**
     * Get tagsImages
     *
     * @return \Doctrine\Common\Collections\Collection
    */
    public function getEtiquetasImagenes()
    {
        return $this->etiquetas_imagenes;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->etiquetas_imagenes = new \Doctrine\Common\Collections\ArrayCollection();
    }
}
