<?php

namespace Binaerpiloten\MagicBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class KarteFilterType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typ','entity',array(
            		'multiple' => true,
            		'expanded' => true,
            		'required' => false,
            		'class' => 'BinaerpilotenMagicBundle:Typ',
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Binaerpiloten\MagicBundle\Entity\KarteFilter'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'binaerpiloten_magicbundle_kartefilter';
    }
}
