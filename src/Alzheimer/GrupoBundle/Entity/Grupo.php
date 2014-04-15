<?php

namespace Alzheimer\GrupoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Grupo
 *
 * @ORM\Table(name="grupo")
 * @ORM\Entity
 */
class Grupo
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
     * @ORM\Column(name="Descripcion", type="string", length=20)
     */
    private $Descripcion;

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
     * Set Descripcion
     *
     * @param string $descripcion
     * @return Niveles
     */
    public function setDescripcion($descripcion)
    {
        $this->Descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get Descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->Descripcion;
    }

    public function __toString()
    {
        return $this->getDescripcion();
    }
}
