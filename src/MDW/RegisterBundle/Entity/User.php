<?php

namespace MDW\RegisterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class User implements AdvancedUserInterface, \Serializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     *@Assert\NotNull(message = "Escribe un nombre de usuario")
     */
    private $username;

    /**
    * @ORM\Column(name="is_active", type="boolean")
    */
    private $isActive;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=64)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     *@Assert\Email(
     *  message = "El mail '{{ value }}' no tiene el formato adecuado"
     *)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="roles", type="string", length=30)
     *@Assert\NotNull
     */
    private $roles;


    /**
     * Get id
     *
     * @return integer
     */

     /**
   * @Assert\NotBlank()
   * @Assert\Length(max = 4096)
   */
   private $plainPassword;

   public function getPlainPassword()
   {
     return $this->plainPassword;
   }

   public function setPlainPassword($password)
   {
     $this->plainPassword = $password;
   }

   public function __construct()
   {
     //parent::__construct();
     // your own logic
     $this->isActive = 1;
     $this->roles = 'ROLE_USER';
     $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
     //$this->isActive = true;
     // may not be needed, see section on salt below
     // $this->salt = md5(uniqid(null, true));
   }

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userName
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
    * Set isActive
    *
    * @param boolean $isActive
    *
    * @return User
    */
    public function setIsActive($isActive)
    {
      $this->isActive = $isActive;

      return $this;
    }

    /**
    * Get isActive
    *
    * @return boolean
    */
    public function getIsActive()
    {
      return $this->isActive;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function eraseCredentials()
    {
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set role
     *
     * @param string $roles
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRoles()
    {
        return array($this->roles);
    }

    /** @see \Serializable::serialize() */
  public function serialize()
  {
    return serialize(array(
      $this->id,
      $this->username,
      $this->password,
      // see section on salt below
      // $this->salt,
    ));
  }

  /** @see \Serializable::unserialize() */
  public function unserialize($serialized)
  {
    list (
    $this->id,
    $this->username,
    $this->password,
    // see section on salt below
    // $this->salt
    ) = unserialize($serialized);
  }

  public function getSalt()
  {
    // you *may* need a real salt depending on your encoder
    // see section on salt below
    return null;
  }

  public function hasRole($roles) {
    if(in_array($roles, $this->getRoles())) return true;
    return false;
  }

  public function isAccountNonExpired(){ return true;}
  public function isAccountNonLocked(){ return true;}
  public function isCredentialsNonExpired(){return true;}

  public function isEnabled(){
    return $this->isActive;
  }

  /**
  * @ORM\OneToOne(targetEntity="\MDW\AlbumBundle\Entity\Galeria", mappedBy="propietario")
  */
  private $galeria;
  /**
  * Set galeria
  *
  * @param \MDW\multimediaBundle\Entity\Galeria $galeria
  *
  * @return User
  */
  public function setGaleria(\MDW\AlbumBundle\Entity\Galeria $galeria)
  {
    $this->galeria = $galeria;

    return $this;
  }

  /**
  * Get galeria
  *
  *  @return \MDW\AlbumBundle\Entity\Galeria
  */
  public function getGaleria()
  {
    return $this->galeria;
  }
}
