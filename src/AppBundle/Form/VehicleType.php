<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehicleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                    'label' => false,
                    'attr' => ['placeholder' => 'Nazwa pojazdu']
                ]
            )
            ->add('photoUrl', UrlType::class, [
                    'label' => false,
                    'attr' => ['placeholder' => 'Podaj adres URL obrazka']
                ]
            )
            ->add('description', TextareaType::class, [
                    'label' => false,
                    'attr' => ['placeholder' => 'Podaj opis produktu']
                ]
            )
            ->add('brand', null, [
                'label' => false,
                'attr' => ['placeholder' => 'Marka pojazdu']
            ])
            ->add('engine', null, [
                'label' => false,
                'attr' => ['placeholder' => 'Moc silnika']
            ])
            ->add('year', null, [
                'label' => false,
                'attr' => ['placeholder' => 'Rok produkcji']
            ])
            ->add('amount', null, [
                'label' => false,
                'attr' => ['placeholder' => 'Ilość dostępnych pojazdów']
            ])
            ->add('price', null, [
                'label' => false,
                'attr' => ['placeholder' => 'Koszt wynajmu (jeden dzień)']
            ])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Vehicle'
        ));
    }
}
