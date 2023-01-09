<?php

namespace App\Controller\Admin;

use App\Entity\RDV;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\{ArrayField, ChoiceField,ImageField, DateField, BooleanField, Field, IdField, TextField, IntegerField,AssociationField};
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\{Crud};

class RDVCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RDV::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('raison'),
            TextField::new('description'),
            TextField::new('lieu'),
            DateField::new('date'),
            IntegerField::new('temps'),
            AssociationField::new('agent')->setCrudController(AgentCrudController::class)->onlyOnIndex(),
            AssociationField::new('citoyen')->setCrudController(CitoyenCrudController::class)->hideWhenUpdating(),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
             ->setPermission(Action::DELETE, 'ROLE_RESPONSABLE')
             ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

}
