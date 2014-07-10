<?php

namespace Alzheimer\EventosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventosType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('descripcion')
            ->add('cuerpo', 'textarea')
            ->add('lugar', 'textarea')
            ->add('fechaPub','date',array('widget' => 'single_text'))
            ->add('fechaFin','date',array('widget' => 'single_text'))
            ->add('fechaCrea','date',array('widget' => 'single_text'))
            ->add('imagenPrim','file',array('required' => false))
            ->add('imagenSec','file',array('required' => false))
            ->add('guardar', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Alzheimer\EventosBundle\Entity\Eventos'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'alzheimer_eventosbundle_eventos';
    }
}
