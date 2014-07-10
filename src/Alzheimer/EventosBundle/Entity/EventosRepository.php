<?php

namespace Alzheimer\EventosBundle\Entity;

use Doctrine\ORM\EntityRepository;


class EventosRepository extends EntityRepository
{

	public function NoticiasRecientes()
	{
		$em= $this ->getEntityManager();		
		$dql=$em->createQueryBuilder();

		$dql->select('e')
			->from('EventosBundle:Eventos','e')
			->where('e.fechaPub<=:fecha and e.fechaFin>:fechaP')			
			->orderBy('e.fechaPub','DESC');

			$dql->setParameter('fecha', new \DateTime('tomorrow'));
			$dql->setParameter('fechaP', new \DateTime('yesterday'));					
			return $dql->getQuery()->getResult();
		
	}

	public function NoticiasPasadas()
	{
		$em= $this ->getEntityManager();		
		$dql=$em->createQueryBuilder();

		$dql->select('e')
			->from('EventosBundle:Eventos','e')
			->where('e.fechaPub<=:fecha')
			->orderBy('e.fechaPub','DESC');

			$dql->setParameter('fecha', new \DateTime('yesterday'));	
			return $dql->getQuery()->getResult();

	}

	public function ImagenBanner()
	{	
		$em= $this ->getEntityManager();
		$dql=$em->createQueryBuilder();
			
			$dql->select('i.id,i.imagenSec, i.fechaPub','i.titulo')
			->from('EventosBundle:Eventos','i')			
			->where('i.fechaPub<=:fecha and i.fechaFin>:fechaP')
			->orderBy('i.fechaPub','DESC');			

			$dql->setParameter('fecha', new \DateTime('tomorrow'));
			$dql->setParameter('fechaP', new \DateTime('yesterday'));
			return $dql->getQuery()->getResult();
	}

}