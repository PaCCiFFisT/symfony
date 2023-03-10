<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GetUserByFieldType extends AbstractType
{

    public function buildForm(
        FormBuilderInterface $builder,
        array                $options
    ): void
    {
        $builder
            ->add('id', NumberType::class, ['required' => FALSE])
            ->add('name', TextType::class, ['required' => FALSE])
            ->add('email', EmailType::class, ['required' => FALSE])
            ->add('city', TextType::class, ['required' => FALSE])
            ->add('role', ChoiceType::class, [
                'choices' => [
                    ''=>'',
                    'User' => 'user',
                    'Admin' => 'admin',
                ],
                'attr'=>['title'=>''],
                'required'=>FALSE
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Submit!',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }

}
