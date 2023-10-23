<?php

namespace App\Controller\Admin;

use App\Entity\Amende;
use App\Entity\Blessure;
use App\Entity\Certificats;
use App\Entity\Citoyen;
use App\Entity\PeinePrison;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\{Crud};

class CitoyenCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Citoyen::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('Username'),
            DateField::new('dateNaissance'),
            IntegerField::new('Num_Telephone'),
            TextField::new('sexe'),
            IntegerField::new('taille'),
            TextField::new('metier'),
            TextField::new('GroupeSanguin'),
            IntegerField::new('poids'),
            IntegerField::new('NumeroUrgence'),
            ImageField::new('imageName', 'Image')
            ->hideOnForm()
            ->setBasePath('/avatar')
            ->setUploadDir('public/avatar')->setFormTypeOptions(['required' => true]),
            Field::new('imageFile')->setFormType(VichImageType::class)->onlyOnForms()->setFormTypeOptions(['required' => true]),

            AssociationField::new('blessures')->setCrudController(BlessureCrudController ::class)->hideOnForm(),
            AssociationField::new('certificats')->setCrudController(CertificatsCrudController::class)->hideOnForm(),
            AssociationField::new('examens')->setCrudController(ExamenCrudController::class)->hideOnForm(),
            AssociationField::new('operations')->setCrudController(OperationCrudController::class)->hideOnForm(),
            AssociationField::new('rDVs','Rendez-Vous')->setCrudController(RDVCrudController::class)->hideOnForm(),
            AssociationField::new('therapies')->setCrudController(TherapieCrudController::class)->hideOnForm(),
            AssociationField::new('vente')->setCrudController(VenteCrudController::class)->hideOnForm(),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->disable(Action::DELETE)
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
        ;
    }

}
