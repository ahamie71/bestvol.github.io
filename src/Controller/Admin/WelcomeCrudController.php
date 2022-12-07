<?php

namespace App\Controller\Admin;

use App\Entity\Welcome;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class WelcomeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Welcome::class;
    }
    public function configureFigureCrud(Crud $crud):crud
    {
        return $crud
            ->setEntityLabelInplural('Welcome') 
            ->setENtityLabel('welcome') ; 
         }
         public function configureFields(string $pageName): iterable
         {
             return [
                 TextField::new('titre'),
                 TextField::new('soustitre'),
                 ImageField::new('image')
                 ->setBasePath('welcome/')
                ->setUploadDir('public/welcome')
               -> setUploadedFileNamePattern('[randomhash].[extension]')
             ];
}
}
