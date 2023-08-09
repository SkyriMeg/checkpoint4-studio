<?php

namespace App\Form;

use App\Entity\Equipment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class EquipmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category', null, [
                'choice_label' => 'name',
                'label' => 'Catégorie'
            ])
            ->add('type', null, [
                'choice_label' => 'name',
                'label' => 'Type'
            ])
            ->add('brand', null, [
                'choice_label' => 'name',
                'label' => 'Marque'
            ])
            ->add('model', TextType::class, [
                'required' => true,
                'label' => 'Modèle'
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['rows' => 5],
                'label' => 'Description'
            ])
            ->add('pictureFile', VichFileType::class, [
                'required' => true,
                'allow_delete'  => false, // default is true
                'download_uri' => false, // default is true
                'label' => 'Image'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipment::class,
        ]);
    }
}
