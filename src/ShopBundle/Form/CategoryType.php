<?php

namespace ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => 'input comment',
                'attr' => array('class' => 'width_input')
                                    )
                )
            ->add('picture', 'file', array(
                'label' => 'input comment',
                'data_class' => null,
                'attr' => array('class' => 'width_input')
                                                )
                       )
            ->add('description', 'textarea', array(
                    'label' => 'input comment',
                    'attr' => array('class' => 'width_input')
                )
            )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ShopBundle\Entity\Category'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'shopbundle_category';
    }
}

