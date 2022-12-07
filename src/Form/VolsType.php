<?php

namespace App\Form;
use App\Entity\Company;
use App\Entity\Vols;
use App\Repository\CompanyRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VolsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('depart', DateType::class,[
            "label"=>false,
            'required' =>false,
            'widget'=>'single_text',
            'attr'=> [ 'class'=>"js-depart  js-datepicker", ],
        ])
        ->add('destination' ,TextType::class,[
            'required' =>false,
            "label"=>false,
           
            'attr'=> ['class'=> 'js-destination form-control'],
        ])
        ->add('datederetour',DateType::class,[
            "label"=>false,
            'required' =>false,
            'widget'=>'single_text',
            
            'attr'=> [ 'class'=> "js-datederetour js-datepicker "],
        ])
        
        ->add('tarif' , TextType::class,[
            'required' =>false,
            "label"=>false,
            'attr'=> ["class"=> "js-tarif form-control"]
             ])

             ->add('idCompany', EntityType::class, [
                // looks for choices from this entity
                  'attr'=>['class' =>'js-idCompany form-control'],

                  'class' => Company::class,

                'placeholder' => 'Choose a Company',

                'query_builder' => function(CompanyRepository $er) {
                    return $er->createQueryBuilder('u');
                    
                    
                  
                },
                
                'choice_label' => 'name',
                 
                'required' =>false,
    
            ])
    
            
             ->add('submit', SubmitType::class, [
                'label' => "rechercher",
                'attr' => [
                    'class' => 'btn btn-primary js-rechercher  '
                    
                    
                ] 

              ])
              
              ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vols::class,
        ]);
    }
}
