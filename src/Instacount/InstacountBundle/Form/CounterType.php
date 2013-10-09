<?php

namespace Instacount\InstacountBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CounterType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            //->add('count')
            ->add('campaign', 'entity', array(
                'class' => 'InstacountInstacountBundle:Campaign',
                'property' => 'tag',
                'empty_value' => 'Välj en kampanj!')
            );
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Instacount\InstacountBundle\Entity\Counter'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'instacount_instacountbundle_counter';
    }
}
