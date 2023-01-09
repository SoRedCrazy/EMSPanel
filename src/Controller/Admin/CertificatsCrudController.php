<?php

namespace App\Controller\Admin;

use App\Entity\Certificats;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\{ArrayField, ChoiceField,ImageField, DateField, BooleanField, Field, IdField, TextField, IntegerField,AssociationField};
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\{Crud};

class CertificatsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Certificats::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            ChoiceField::new('type')->setChoices([
                // $value => $badgeStyleName
                'Arrêt Maladie' => 'Arrêt Maladie',
                'Permis de port d\'arme' => 'Permis de port d\'arme',
                'Arrêt Travail' => 'Arrêt Travail',
                'Certificat d\'aptitude' => 'Certificat d\'aptitude',
            ]),
            TextField::new('observations'),
            TextField::new('note'),
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
