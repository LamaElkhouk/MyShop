<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class,['attr'=>['placeholder'=>'Pseudo41','class'=>'formcontrol']])
            ->add('nomComplet',TextType::class,['attr'=>['value'=>'Martin Dupond','class'=>'formcontrol']])

            //->add('roles')
            ->add('password',PasswordType::class,['attr'=>['placeholder'=>'Mot de passe','class'=>'formcontrol']])
            ->add('confirmePassword',PasswordType::class,['attr'=>['placeholder'=>'Mot de passe','class'=>'formcontrol']])
            ->add('email',EmailType::class,['attr'=>['value'=>'exemple@gmail.com','class'=>'formcontrol']])
            ->add('dateNaissance',BirthdayType::class,['attr'=>['class'=>'form-control2']])
            ->add('numeroTelephone',TelType::class,['attr'=>['placeholder'=>'0678451212','class'=>'formcontrol']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
