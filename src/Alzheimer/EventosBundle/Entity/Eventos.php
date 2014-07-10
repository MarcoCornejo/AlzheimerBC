<?php

namespace Alzheimer\EventosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Eventos
 *
 * @ORM\Table(name="Eventos")
 * @ORM\Entity(repositoryClass="Alzheimer\EventosBundle\Entity\EventosRepository")
 */
class Eventos
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
     * @ORM\Column(name="titulo", type="string", length=40)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="cuerpo", type="text")
     */
    private $cuerpo;

    /**
     * @var \string
     *
     * @ORM\Column(name="lugar", type="string", length=255)
     */
    private $lugar;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaPub", type="date")
     */
    private $fechaPub;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaFin", type="date")
     */
    private $fechaFin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCrea", type="date")
     */
    private $fechaCrea;

    /**
     * 
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $imagenPrim;

    /**
     * 
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $imagenSec;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    protected $descripcion;

    /**
     *
     * @Assert\Image(maxSize = "500k", maxWidth = 300,minWidth =1000,minHeight=300, maxHeight = 300)
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
     * Set titulo
     *
     * @param string $titulo
     * @return Eventos
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set cuerpo
     *
     * @param string $cuerpo
     * @return Eventos
     */
    public function setCuerpo($cuerpo)
    {
        $this->cuerpo = $cuerpo;

        return $this;
    }

    /**
     * Get cuerpo
     *
     * @return string 
     */
    public function getCuerpo()
    {
        return $this->cuerpo;
    }


    /**
     * Set lugar
     *
     * @param string $lugar
     * @return Eventos
     */
    public function setLugar($lugar)
    {
        $this->lugar = $lugar;

        return $this;
    }

    /**
     * Get lugar
     *
     * @return string 
     */
    public function getLugar()
    {
        return $this->lugar;
    }

    /**
     * Set fechaPub
     *
     * @param \DateTime $fechaPub
     * @return Eventos
     */
    public function setFechaPub($fechaPub)
    {
        $this->fechaPub = $fechaPub;

        return $this;
    }

    /**
     * Get fechaPub
     *
     * @return \DateTime 
     */
    public function getFechaPub()
    {
        return $this->fechaPub;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     * @return Eventos
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime 
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set fechaCrea
     *
     * @param \DateTime $fechaCrea
     * @return Eventos
     */
    public function setFechaCrea($fechaCrea)
    {
        $this->fechaCrea = $fechaCrea;

        return $this;
    }

    /**
     * Get fechaCrea
     *
     * @return \DateTime 
     */
    public function getFechaCrea()
    {
        return $this->fechaCrea;
    }

    /**
     * Set imagenPrim
     *
     * @param string $foto
     * 
     */
    public function setImagenPrim($imagenPrim)
    {
        $this->imagenPrim = $imagenPrim;

        return $this;
    }

    /**
     * Get imagenPrim
     *
     * @return string 
     */
    public function getImagenPrim()
    {
        return $this->imagenPrim;
    }

    /**
     * Set imagenSec
     *
     * @param string $foto
     * 
     */
    public function setImagenSec($imagenSec)
    {
        $this->imagenSec = $imagenSec;

        return $this;
    }

    /**
     * Get imagenSec
     *
     * @return string 
     */
    public function getImagenSec()
    {
        return $this->imagenSec;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Eventos
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
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

    
    public function subirFoto($directorioDestino)
    {
        if (null === $this->getImagenPrim()) {
            return;
        }
        

        $nombreArchivoFoto = $this->getImagenPrim()->getClientOriginalName();

        $this->getImagenPrim()->move($directorioDestino, $nombreArchivoFoto);


        $this->setImagenPrim($nombreArchivoFoto);
        
    }
     public function subirFoto2($directorioDestino)
    {
     if (null === $this->getImagenSec()) {
            return;
        }
    $nombreArchivoFoto2 = $this->getImagenSec()->getClientOriginalName();
    $this->getImagenSec()->move($directorioDestino, $nombreArchivoFoto2);
    $this->setImagenSec($nombreArchivoFoto2);
    }

    public function __toString()
    {
        return $this->getTitulo();
    }

}
