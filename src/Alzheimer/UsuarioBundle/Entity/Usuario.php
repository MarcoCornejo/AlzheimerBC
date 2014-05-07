<?php

namespace Alzheimer\UsuarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Usuario
 *
 * @ORM\Table(name="Usuario")
 * @ORM\Entity()
 */
class Usuario
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
     * @ORM\ManyToOne(targetEntity="Alzheimer\NivelBundle\Entity\Nivel")
     * @ORM\JoinColumn(name="nivel_ID", referencedColumnName="id")
     */
    private $nivel_ID;

    /**
     * @ORM\ManyToOne(targetEntity="Alzheimer\GrupoBundle\Entity\Grupo")
     * @ORM\JoinColumn(name="grupo_ID", referencedColumnName="id")
     */
    private $grupo_ID;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=20)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45)
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
     * @ORM\Column(name="correo", type="string", length=50)
     */
    private $correo;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Usuarios
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
     * Set nombre
     *
     * @param string $nombre
     * @return Usuarios
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
     * Set correo
     *
     * @param string $correo
     * @return Usuarios
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string 
     */
    public function getCorreo()
    {
        return $this->correo;
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
     * Set nivel_ID
     *
     * @param \int \Alzheimer\NivelBundle\Entity\Nivel
     * @return Nivel
     */
    public function setNivelID(\Alzheimer\NivelBundle\Entity\Nivel $nivelID)
    {
        $this->nivel_ID = $nivelID;
    }

    /**
     * Get nivel_ID
     *
     * @return \Alzheimer\NivelBundle\Entity\Nivel
     */
    public function getNivelID()
    {
        return $this->nivel_ID;
    }

    /**
     * Set grupo_ID
     *
     * @param \int \Azlheimer\GrupoBundle\Entity\Grupo
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

    public function __toString()
    {
        return $this->getNombre();
    }

}