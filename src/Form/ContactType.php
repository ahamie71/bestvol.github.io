<?php

namespace App\Form;
use App\Entity\Message;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextAreaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class,[
                "label"=>false
            ])
            
            ->add('text',TextAreaType::class,[
                "label"=>false
            ])
            ->add('idUser',EntityType::class, [
                // looks for choices from this entity
                 
                  'class' => User::class,
               
                'query_builder' =>function(UserRepository $er) {
                    return $er->createQueryBuilder('u');
                    
                    
                  
                },
                
                'choice_label' => 'nom',
                 
    
    
            ])

            ->add('submit', SubmitType::class, [
                'label' => "envoyer",
                'attr' => [
                    'class' => 'btn btn-primary'
                ] 
            ])


            ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
