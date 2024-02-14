<?php

namespace App\Form;

use App\Entity\Note;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteType extends AbstractType
{
    public function __construct(

        private UserRepository $userRepository,
    )
    {}

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class)
            ->add('note',TextareaType::class)
            ->add('user', EntityType::class, [
                'label'=>'Para usuario administrador',
                'class' => User::class,
                'choices' => $this->userRepository->getChoiceList(), //Nota a usuario administrador
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Note::class,
        ]);
    }
}
