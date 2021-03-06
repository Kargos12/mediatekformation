<?php

namespace App\Form;

use App\Entity\Formation;
use App\Entity\Niveaux;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('publishedAt', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required' => true,
                ))
            ->add('title', TextType::class, ['required' => true])
            ->add('description', TextType::class)
            ->add('miniature', UrlType::class)
            ->add('picture', UrlType::class)
            ->add('videoId',TextType::class)
            ->add('niveau', EntityType::class, [
                    'class' => Niveaux::class,
                    'choice_label' => 'nom',
                    'required' => true
            ])
            ->add('submit', SubmitType::class,[
                
                'label' => 'Enregistrer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
