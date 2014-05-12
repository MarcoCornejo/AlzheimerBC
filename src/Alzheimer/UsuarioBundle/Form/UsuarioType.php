<?php

namespace Alzheimer\UsuarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuarioType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('nombre')
            ->add('a_paterno')
            ->add('a_materno')
            ->add('correo')
            ->add('contacto')            
            ->add('nivel_ID')
            ->add('grupo_ID')
            ->add('foto', 'file', array('required' => false))
            ->add('guardar', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Alzheimer\UsuarioBundle\Entity\Usuario'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'alzheimer_usuariobundle_usuario';
    }
}
