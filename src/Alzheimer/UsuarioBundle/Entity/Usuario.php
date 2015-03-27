<?php
namespace Alzheimer\UsuarioBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Usuario
 *
 * @ORM\Table(name="usuarios")
 * @ORM\Entity
 */
class Usuario implements UserInterface, \Serializable
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
     * @ORM\ManyToOne(targetEntity="Alzheimer\GrupoBundle\Entity\Grupo")
     * @ORM\JoinColumn(name="grupo_ID", referencedColumnName="id")
     */
    private $grupo_ID;
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=80)
     */
    private $nombre;
    /**
     * @var string
     *
     * @ORM\Column(name="a_paterno", type="string", length=25)
     */
    private $a_paterno;
    /**
     * @var string
     *
     * @ORM\Column(name="a_materno", type="string", length=25)
     */
    private $a_materno;
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100)
     */
    private $email;
    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=100)
     */
    private $password;
     /**
     * @var string
     *
     * @ORM\Column(name="contacto", type="text")
     */
    private $contacto;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $rutaFoto;
    /**
     *
     * @Assert\Image(maxSize = "500k", maxWidth = 300, maxHeight = 300)
     */
    protected $foto;
    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;
    /**
     * @ORM\ManyToMany(targetEntity="Rol")
     * @ORM\JoinTable(
     *  name="usuario_rol",
     *  joinColumns={@ORM\JoinColumn(name="usuario_id", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="rol_id", referencedColumnName="id")}
     * )
     */
    protected $roles;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
    }
    function eraseCredentials() {}
    function getUsername()
    {
        return $this->getEmail();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Usuario
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
     * Set a_paterno
     *
     * @param string $aPaterno
     * @return Usuarios
     */
    public function setAPaterno($aPaterno)
    {
        $this->a_paterno = $aPaterno;
        return $this;
    }
    /**
     * Get a_paterno
     *
     * @return string 
     */
    public function getAPaterno()
    {
        return $this->a_paterno;
    }
    /**
     * Set a_materno
     *
     * @param string $aMaterno
     * @return Usuarios
     */
    public function setAMaterno($aMaterno)
    {
        $this->a_materno = $aMaterno;
        return $this;
    }
    /**
     * Get a_materno
     *
     * @return string 
     */
    public function getAMaterno()
    {
        return $this->a_materno;
    }
    /**
     * Set email
     *
     * @param string $email
     * @return Usuario
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
     * Set password
     *
     * @param string $password
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
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
     * Set contacto
     *
     * @param string $contacto
     * @return Usuarios
     */
        public function setContacto($contacto)
        {
            $this->contacto = $contacto;
            return $this;
        }
    /**
     * Get contacto
     *
     * @return string 
     */
    public function getContacto()
    {
        return $this->contacto;
    }
     /**
     * Set grupo_ID
     *
     * @param  \Azlheimer\GrupoBundle\Entity\Grupo
     * @return Grupo
     */
    public function setGrupoID(\Alzheimer\GrupoBundle\Entity\Grupo $grupoID)
    {
        $this->grupo_ID = $grupoID;
    }
    /**
     * Get grupo_ID
     *
     * @return \Alzheimer\GrupoBundle\Entity\Grupo
     */
    public function getGrupoID()
    {
        return $this->grupo_ID;
    }
        /**
     * Set rutaFoto
     *
     * @param string $foto
     */
    public function setRutaFoto($rutaFoto)
    {
        $this->rutaFoto = $rutaFoto;
    }
    /**
     * Get rutaFoto
     *
     * @return string
     */
    public function getRutaFoto()
    {
        return $this->rutaFoto;
    }
    /**
     * Set foto.
     *
     * @param UploadedFile $foto
     */
    public function setFoto(UploadedFile $foto = null)
    {
        $this->foto = $foto;
    }
    /**
     * Get foto.
     *
     * @return UploadedFile
     */
    public function getFoto()
    {
        return $this->foto;
    }
    /**
     * Sube la foto de la oferta copiándola en el directorio que se indica y
     * guardando en la entidad la ruta hasta la foto
     *
     * @param string $directorioDestino Ruta completa del directorio al que se sube la foto
     */
    public function subirFoto($directorioDestino)
    {
        if (null === $this->getFoto()) {
            return;
        }
        $nombreArchivoFoto = $this->getFoto()->getClientOriginalName();
        $this->getFoto()->move($directorioDestino, $nombreArchivoFoto);
        $this->setRutaFoto($nombreArchivoFoto);
    }
    /**
     * Set salt
     *
     * @param string $salt
     * @return Usuario
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    
        return $this;
    }
    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }
    /**
     * Add roles
     *
     * @param \Alzheimer\UsuarioBundle\Entity\Rol $roles
     * @return Usuario
     */
    public function addRole(\Alzheimer\UsuarioBundle\Entity\Rol $roles)
    {
        $this->roles[] = $roles;
    
        return $this;
    }
    /**
     * Remove roles
     *
     * @param \Alzheimer\UsuarioBundle\Entity\Rol $roles
     */
    public function removeRole(\Alzheimer\UsuarioBundle\Entity\Rol $roles)
    {
        $this->roles->removeElement($roles);
    }
    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoles()
    {
        return $this->roles->toArray();
    }
    public function setRoles($roles) {
        $this->user_roles = $roles;
    }

public function serialize()
{
    return json_encode(
            array($this->nombre,
                $this->a_paterno,
                $this->a_materno,
                $this->email,
                $this->contacto,
                $this->rutaFoto,
                $this->foto,
                $this->grupo_ID,
                $this->password,
                $this->salt,
                $this->roles,
                $this->id));
}

/**
 * Unserializes the given string in the current User object
 * @param serialized
 */
public function unserialize($serialized)
{
    list($this->nombre,
        $this->a_paterno,
        $this->a_materno,
        $this->email,
        $this->contacto,
        $this->rutaFoto,
        $this->foto,
        $this->grupo_ID,
        $this->password,
        $this->salt,
        $this->roles,
        $this->id) = json_decode($serialized);
}  
}
