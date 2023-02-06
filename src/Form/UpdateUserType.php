<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id', ChoiceType::class, [
                'required' => true,
                'choices' => [
                    $options['id_options']
                ],
            ])
            ->add('name', TextType::class, ['required' => FALSE])
            ->add('email', EmailType::class, ['required' => FALSE])
            ->add('password', TextType::class, ['required' => FALSE])
            ->add('button', SubmitType::class,[
                'label'=>$options['btn_text']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'id_options' => null,
            'btn_text'=>null
        ]);
    }


}