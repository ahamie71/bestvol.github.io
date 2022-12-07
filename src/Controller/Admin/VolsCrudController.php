<?php

namespace App\Controller\Admin;

use App\Entity\Vols;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VolsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vols::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
