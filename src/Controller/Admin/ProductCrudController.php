<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }




    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom'),
            AssociationField::new('category', 'Catégories'),
            AssociationField::new('supplier', 'Fournisseur'),
            
            MoneyField::new('price', 'Prix')->setCurrency('EUR')->setStoredAsCents(false),
            TextareaField::new('description', 'Description'),
            ImageField::new('image_product', 'Image du produit')
            ->setBasePath('products/')
                ->setUploadDir('public/uploads/products')
                ->setUploadedFileNamePattern('[name].[extension]')
                ->setRequired(false),
            NumberField::new('weight', 'Poids'),
            SlugField::new('slug')->setTargetFieldName('name'),
        ];
    }

}
