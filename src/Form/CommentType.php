<?php

namespace App\Form;

use App\Entity\Comments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo',null,[
                'attr' => ['class' => 'input-group form-control']
            ])
            ->add('contents',null,[
                'attr' => ['class' => 'input-group form-control'],
                'label' => 'Commentaire'
            ])
            ->add('note',null,[
                'attr' => ['class' => 'input-group form-control']
            ])
            ->add('commenter', SubmitType::class,[
                'attr' => ['class' => 'btn btn-secondary mt-3 w-100']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comments::class,
        ]);
    }
}
