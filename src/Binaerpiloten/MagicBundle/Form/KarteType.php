<?php

namespace Binaerpiloten\MagicBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class KarteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('anzahl')
            ->add('mana')
            ->add('farbe','entity',array(
            		'multiple' => true,
            		'expanded' => true,
            		'class' => 'BinaerpilotenMagicBundle:Farbe')
            )
            ->add('typ','entity',array(
            		'multiple' => true,
            		'expanded' => true,
            		'class' => 'BinaerpilotenMagicBundle:Typ')
            )
            ->add('seltenheit','entity',array(
            		'multiple' => false,
            		'expanded' => true,
            		'class' => 'BinaerpilotenMagicBundle:Seltenheit')
            )
            ->add('edition','entity',array(
            		'multiple' => false,
            		'expanded' => true,
            		'class' => 'BinaerpilotenMagicBundle:Edition')
            )
            ->add('batchitem','entity',array(
            		'multiple' => false,
            		'expanded' => true,
            		'required' => false,
            		'class' => 'BinaerpilotenMagicBundle:BatchItem')
            )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Binaerpiloten\MagicBundle\Entity\Karte'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'binaerpiloten_magicbundle_karte';
    }
}
