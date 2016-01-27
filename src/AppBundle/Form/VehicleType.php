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
        $label = $builder->getOption('label', false);

        $builder
            ->add('name', null, [
                    'label' => $label?'Nazwa pojazdu':false,
                    'attr' => ['placeholder' => 'Nazwa pojazdu']
                ]
            )
            ->add('photoUrl', UrlType::class, [
                    'label' => $label?'URL obrazka':false,
                    'attr' => ['placeholder' => 'Podaj adres URL obrazka']
                ]
            )
            ->add('description', TextareaType::class, [
                    'label' => $label?'Opsi pojazdu':false,
                    'attr' => ['placeholder' => 'Podaj opis pojazdu']
                ]
            )
            ->add('brand', null, [
                'label' => $label?'Marka pojazdu':false,
                'attr' => ['placeholder' => 'Marka pojazdu']
            ])
            ->add('engine', null, [
                'label' => $label?'Silnik pojazdu':false,
                'attr' => ['placeholder' => 'Moc silnika']
            ])
            ->add('year', null, [
                'label' => $label?'Rok produkcji':false,
                'attr' => ['placeholder' => 'Rok produkcji']
            ])
            ->add('amount', null, [
                'label' => $label?'Ilośc dostępnych pojazdów':false,
                'attr' => ['placeholder' => 'Ilość dostępnych pojazdów']
            ])
            ->add('price', null, [
                'label' => $label?'Koszt wynajmu':false,
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
