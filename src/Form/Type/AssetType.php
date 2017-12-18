<?php

namespace App\Form\Type;

use App\Entity\Asset;
use App\Entity\Coin;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssetType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('coin', EntityType::class, [
                'class' => Coin::class,
                'choice_label' => 'name',
            ])
            ->add('holdings')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Asset::class,
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'app_form_asset';
    }
}
