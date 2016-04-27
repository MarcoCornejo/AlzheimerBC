<?php

namespace Alzheimer\ImagenBundle\Entity;

use Doctrine\ORM\EntityRepository;


class ImagenRepository extends EntityRepository
{

	public function Imagen()
	{
		$em= $this ->getEntityManager();		
		$dql=$em->createQueryBuilder();

		$dql->select('i')
			->from('ImagenBundle:Imagen','i');								
			return $dql->getQuery()->getResult();
		
	}

	
	}