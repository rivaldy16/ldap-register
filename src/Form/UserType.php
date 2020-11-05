<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\File;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nik', NumberType::class, [
                'required' => false
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => false
            ])
            ->add('email', EmailType::class, [
                'required' => false
            ])
            ->add('nama_depan', TextType::class, [
                'required' => false
            ])
            ->add('nama_belakang', TextType::class, [
                'required' => false
            ])
            ->add('ktp', FileType::class, [
                'label' => 'file',
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        // 'mimeTypes' => [
                        //     'application/pdf',
                        //     'application/x-pdf',
                        // ],
                        // 'mimeTypesMessage' => 'Please upload a valid PDF or JPG document',
                    ])
                ],
                'required' => false
            ]);          
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
