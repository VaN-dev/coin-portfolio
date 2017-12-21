<?php

namespace App\Form\Type;

use App\Entity\Fiat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiatType extends AbstractType
{
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'class' => Fiat::class,
            'choice_label' => 'name',
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'app_form_fiat';
    }

    public function getParent()
    {
        return EntityType::class;
    }
}
