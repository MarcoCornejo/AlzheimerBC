<?php

namespace Alzheimer\ImagenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Imagen
 *
 * @ORM\Table(name="Imagen")
 * @ORM\Entity(repositoryClass="Alzheimer\ImagenBundle\Entity\ImagenRepository")
 * 
 */
class Imagen
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
     * @ORM\Column(name="img", type="string", length=255, nullable=true)
     */
    private $img;

    /**
     * @var string
     *
     * @ORM\Column(name="imgsec", type="string", length=255, nullable=true)
     */
    private $imgsec;

    /**
     * @var string
     *
     * @ORM\Column(name="imgtres", type="string",length=255 , nullable=true)
     */
    private $imgtres;

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
     * Set img
     *
     * @param string $foto
     * 
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return string 
     */
    public function getImg()
    {
        return $this->img;
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
        if (null === $this->getImg()) {
            return;
        }
        

        $nombreArchivoFoto = $this->getImg()->getClientOriginalName();    
        $this->getImg()->move($directorioDestino, $nombreArchivoFoto);
        $this->setImg($nombreArchivoFoto);
        
    }
    
}
