<?php

namespace App\Controller\Admin;

use App\Entity\Chambres;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ChambresCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Chambres::class;
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
