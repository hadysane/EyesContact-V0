<?php

namespace App\Controller\Admin;

use App\Entity\Address;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AddressCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Address::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom')
                ->setRequired(true),
            TextField::new('country', 'Pays')
                ->setRequired(true),
            TextField::new('city', 'Ville')
                ->setRequired(true),
            TextField::new('zipCode', 'Code Postal')
                ->setRequired(true),
            TextField::new('street', 'Rue')
                ->setRequired(true),
        ];
    }
}
