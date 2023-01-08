<?php

namespace App\Controller\Admin;

use App\Entity\Commentaire;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CommentaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commentaire::class;
    }

    public  function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular("Commentaire de la conférence")
            ->setEntityLabelInPlural("Commentaires de la conférence")
            ->setSearchFields(['auteur', 'texte', 'email'])
            ->setDefaultSort(['dateCreation' => 'DESC']);
    }


    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('conference');
        yield TextField::new('auteur');
        yield EmailField::new('email');
        yield TextareaField::new('texte')
            ->hideOnIndex();
        yield TextField::new('photo')
            ->onlyOnIndex();
        $dateCreation = DateTimeField::new('dateCreation')->setFormTypeOptions([
            'html5' => true,
            'years' => range(date('Y'), date('Y') + 5),
            'widget' => 'single_text'
        ]);
        if(Crud::PAGE_EDIT === $pageName){
            yield $dateCreation->setFormTypeOption('disabled', true);
        }else{
            yield $dateCreation;
        }
    }

}
