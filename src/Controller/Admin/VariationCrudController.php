<?php

namespace App\Controller\Admin;

use App\Entity\Variation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class VariationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Variation::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('product', 'Produit concerné'),
            AssociationField::new('color', 'Couleur'),
        ];
    }
    
}
