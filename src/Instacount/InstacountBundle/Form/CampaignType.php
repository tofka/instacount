<?php

namespace Instacount\InstacountBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;

class CampaignType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('start_date', 'date', array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'label' => 'Startdatum (åååå-mm-dd)'
                ))
            ->add('end_date', 'date', array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'label' => 'Enddatum (åååå-mm-dd)'
                ))
            ->add('name', null, array(
                'label' => 'Namn'
                ))   
            ->add('tag', null, array(
                'label' => 'Tag'
                )) 
            ->add('facebook_url', null, array(
                'label' => 'Facebook-url'
                )) 
            //->add('facebook_url')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Instacount\InstacountBundle\Entity\Campaign'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'instacount_instacountbundle_campaign';
    }
}
