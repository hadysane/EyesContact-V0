<?php

namespace App\Controller\Admin;

use App\Entity\ColorAttribute;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ColorAttributeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ColorAttribute::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('value', 'Valeur')
                ->setRequired(true),
        ];
    }
}
