<?php
namespace MDW\RegisterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('email', EmailType::class)
          ->add('username', TextType::class)
          ->add('plainPassword', RepeatedType::class, array(
              'type' => 'password',
              'first_options'  => array('label' => 'Password'),
              'second_options' => array('label' => 'Repeat Password'),
          )
      );

    }


    public function getName()
    {
      return 'user_form';
    }

}
