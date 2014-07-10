<?php

namespace Alzheimer\NoticiasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Noticias
 *
 * @ORM\Table(name="noticias")
 * @ORM\Entity
 */
class Noticias
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $imagenPrim; 

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $imagenSec; 

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
     * Set titulo
     *
     * @param string $titulo
     * @return Noticias
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
     * @return Noticias
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Noticias
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
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
