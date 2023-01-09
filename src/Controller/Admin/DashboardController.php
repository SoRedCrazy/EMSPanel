<?php

namespace App\Controller\Admin;

use App\Entity\Agent;
use App\Entity\Blessure;
use App\Entity\Certificats;
use App\Entity\Citoyen;
use App\Entity\Examen;
use App\Entity\Operation;
use App\Entity\Ordonnance;
use App\Entity\RDV;
use App\Entity\Therapie;
use App\Entity\Vente;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class DashboardController extends AbstractDashboardController
{
    #[Route('/', name: 'admin')]
    #[IsGranted('IS_AUTHENTICATED')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         //return $this->redirect($adminUrlGenerator->setController(AgentCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
        return $this->render('stats/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('EMS Panel')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Users');
        yield MenuItem::linkToCrud('Personnel', 'fa-solid fa-user-nurse', Agent::class)->setPermission('ROLE_RESPONSABLE');
        yield MenuItem::linkToCrud('Citoyen', 'fa-solid fa-user', Citoyen::class);
        

        yield MenuItem::section('Papier');
        yield MenuItem::linkToCrud('Certificats', 'fa-solid fa-file-medical', Certificats::class);
        yield MenuItem::linkToCrud('Ordonnance', 'fa-solid fa-file-pen', Ordonnance::class);
        yield MenuItem::linkToCrud('Vente', 'fa-solid fa-pills', Vente::class);
        

        yield MenuItem::section('Maladie');
        yield MenuItem::linkToCrud('Rendez-vous', 'fa-solid fa-calendar-plus', RDV::class);
        yield MenuItem::linkToCrud('Blessure', 'fa-solid fa-bandage', Blessure::class);
        yield MenuItem::linkToCrud('Operation', 'fa-solid fa-x-ray', Operation::class);
        yield MenuItem::linkToCrud('Therapie', 'fa-solid fa-comment-medical', Therapie::class);
        yield MenuItem::linkToCrud('Examen', 'fa-solid fa-microscope', Examen::class);

        yield MenuItem::section('plus');
        yield MenuItem::linkToRoute('Edité', 'fa-solid fa-user-pen','app_edit');
        yield MenuItem::linkToLogout('Logout', 'fa-solid fa-right-from-bracket');
                // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
