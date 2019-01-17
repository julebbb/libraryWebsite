<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Category;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => ['class' => 'col-12 '],
            ])
            ->add('author', TextType::class, [
                'attr' => ['class' => 'col-12 '],
            ])
            ->add('date_release', DateType::class, [
                'widget' => 'single_text',
                'input' => 'datetime',
                'attr' => ['class' => 'col-12'],
            ])
            ->add('resume', TextareaType::class, [
                'attr' => ['class' => 'col-12 '],
            ])
            ->add('category', EntityType::class, array(
                'class' => Category::class,
                'attr' => ['class' => 'col-12'],
                'choice_label' => function ($category) {
                    return $category->getName();
            }))
            ->add('picture', FileType::class, array(
                "required" => false,
                'attr' => ['class' => 'col-12 '],
            ));
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
            'translation_domain' => 'forms'
        ]);
    }
}
