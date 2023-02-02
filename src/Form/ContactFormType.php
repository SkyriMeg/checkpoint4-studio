<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastName', TextType::class, [
                'required' => true,
                'label' => 'Nom'])
            ->add('firstName', null, [
                'required' => true,
                'label' => 'Prénom'])
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'Adresse mail'])
            ->add('subject', ChoiceType::class, [
                'required' => true,
                'label' => 'Sujet',
                'choices' => [
                    '-- Choisissez votre sujet --' => '',
                    'Demande de devis' => '"Demande de devis"',
                    'Demande d\'information' => '"Demande d\'information"',
                    'Autre' => '"Autre"',
                ]])
            ->add('message', TextareaType::class, [
                'attr' => ['rows' => 6],
                'label' => 'Message'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
