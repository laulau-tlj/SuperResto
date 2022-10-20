<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => "Nom"
            ])
            ->add('telephone', TelType::class, [
                'label' => "Telephone"
            ])
            ->add('mail', EmailType::class, [
                'label' => "Mail"
            ])
            ->add('date', DateTimeType::class, [
                'label' => "Date de reservation",
                'years' => range(date('Y'), date('Y') + 2),
                'months' => range(date('m'), 12),
                'days' => range(date('d'), 31)
            ])
            ->add('nbre', NumberType::class, [
                'label' => "Nombre de personne"
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Ajouter"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
