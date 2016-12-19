<?php

namespace MDW\AlbumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use MDW\AlbumBundle\Entity\Galeria;
use MDW\RegisterBundle\Entity\User;

/**
 * Imagen
 *
 * @ORM\Table(name="imagen")
 * @ORM\Entity(repositoryClass="MDW\AlbumBundle\Repository\ImagenRepository")
 */
class Imagen
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
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
    * @Assert\File(maxSize="6000000")
    */
    private $file;

    /**
    * Sets file.
    *
    * @param UploadedFile $file
    */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
    * Get file.
    *
    * @return UploadedFile
    */
    public function getFile()
    {
      return $this->file;
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
     * @return Imagen
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
     * Set path
     *
     * @param string $path
     *
     * @return Imagen
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

    /**
      * @ORM\ManyToOne(targetEntity="Galeria", inversedBy="imagenes")
      * @ORM\JoinColumn(name="galeria_id", referencedColumnName="id",onDelete="CASCADE")
      * @return integer
    */
    private $galeria;

    public function setGaleria(\MDW\AlbumBundle\Entity\Galeria $galeria)
    {
        $this->galeria = $galeria;
    }

    public function getGaleria()
    {
        return $this->galeria;
    }


    /**
      * @ORM\ManyToMany(targetEntity="Etiqueta", mappedBy="etiquetas_imagenes")
    */
    private $etiquetas_imagenes;
    /**
      * Constructor
    */
    public function __construct()
    {
        $this->etiquetas_imagenes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
      * Add tagsImage
    *
      * @param \MDW\AlbumBundle\Entity\Etiqueta $etiquetasImagen
      *
      * @return Imagen
    */
    public function addEtiquetasImagen(\MDW\AlbumBundle\Entity\Etiqueta $EtiquetasImagen)
    {
        $this->etiquetas_imagenes[] = $etiquetasImagen;
    return $this;
    }

    /**
      * Remove etiquetasImagen
      *
      * @param \MDW\AlbumBundle\Entity\Etiqueta $etiquetasImagen
    */
    public function removeEtiquetasImagen(\MDW\AlbumBundle\Entity\Etiqueta $etiquetasImagen)
    {
        $this->etiquetas_imagenes->removeElement($etiquetasImagen);
    }

    /**
      * Get etiquetasImagenes
      *
      * @return \Doctrine\Common\Collections\Collection
    */
    public function getEtiquetasImagenes()
    {
        return $this->etiquetas_imagenes;
    }

    public function hasEtiqueta($etiqueta) {
        if($this->getEtiquetasImagenes()->contains($etiqueta)) return true;
        return false;
    }

    public function getAbsolutePath() {
        return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->path;
    }

    public function getWebPath() {
        return null === $this->path ? null : $this->getUploadDir() . '/' . $this->path;
    }

    public function getUploadRootDir() {
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
        $ds = DIRECTORY_SEPARATOR;
        return 'uploads'.$ds.$this->galeria->getPropietario()->getUsername().$ds.$this->galeria->getNombre();
    }

    public function upload()
    {
    // the file property can be empty if the field is not required
      if (null === $this->getFile()) {
        return;
      }

    // aquí usa el nombre de archivo original pero lo debes
    // sanear al menos para evitar cualquier problema de seguridad

    // move takes the target directory and then the
    // target filename to move to
      $this->getFile()->move(
      $this->getUploadRootDir(),
      //$this->getFile()->getClientOriginalName()
      $this->getNombre()
      );

    // set the path property to the filename where you've saved the file
      $this->path = $this->getNombre();

    // limpia la propiedad «file» ya que no la necesitas más
      $this->file = null;
    }
}
