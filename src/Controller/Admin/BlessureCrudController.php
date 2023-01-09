<?php

namespace App\Controller\Admin;

use App\Entity\Blessure;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\{ArrayField, ChoiceField,ImageField, DateField, BooleanField, Field, IdField, TextField, IntegerField,AssociationField};
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\{Crud};

class BlessureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Blessure::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('soins'),
            ChoiceField::new('graviter')->setChoices([
                // $value => $badgeStyleName
                'faible' => 'faible',
                'moyen' => 'moyen',
                'forte' => 'forte',
            ]),
            DateField::new('date'),
            AssociationField::new('agent')->setCrudController(AgentCrudController::class)->onlyOnIndex(),
            AssociationField::new('citoyen')->setCrudController(CitoyenCrudController::class)->hideWhenUpdating(),
            ImageField::new('imageName', 'Image')
            ->hideOnForm()
            ->setBasePath('/images')
            ->setUploadDir('public/images'),
            Field::new('imageFile')->setFormType(VichImageType::class)->onlyOnForms(),
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
