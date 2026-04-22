<?php

namespace App\Form;

use App\Entity\Folder;
use App\Entity\Priority;
use App\Entity\Status;
use App\Entity\Task;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('isPinned')
            ->add('priority', EntityType::class, [
                'class' => Priority::class,
                'choice_label' => 'id',
            ])
            ->add('folder', EntityType::class, [
                'class' => Folder::class,
                'choice_label' => 'id',
            ])
            ->add('status', EntityType::class, [
                'class' => Status::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
