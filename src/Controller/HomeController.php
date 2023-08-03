<?php

namespace App\Controller;

use App\Controller\HomeController;
use App\Repository\UserRepository;
use App\Repository\SnippetRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    // Route de la page d'accueil
    #[Route('/', name: 'app_home')]
    public function index(
        SnippetRepository $snippets, // Chargement du repository Snippet
        PaginatorInterface $paginator, // Chargement de PaginatorInterface
        Request $request // Chargement de Request
    ): Response {
        // On créer une requête pour récupérer les users
        $query = $snippets->findBy(
            ['IsPublished' => true, 'IsPublic' => true], // Pour sélectionner les users publics et publiés
            ['CreatedAt' => 'DESC'], // Pour trier
            9 // Pour limiter l'affichage
        );

        // On utilise le paginator pour paginer les users
        $pagination = $paginator->paginate(
            $query, // Requête contenant les données à paginer
            $request->query->getInt('page', 1), // Numéro de la page en cours, 1 par défaut
            9 // Nombre de résultats par page
        );

        return $this->render('home/home.html.twig', [
            'snippets' => $pagination
        ]);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
            return new RedirectResponse($targetPath);
        }
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
    }
    //public function user(
    //     UserRepository $users, // Chargement du repository Snippet
    //     Request $request // Chargement de Request
    // ): Response {
    //     // On créer une requête pour récupérer les users
    //     $query = $users->findBy(
      //  $username, $job, $description, $city,$country,$image, $snippets
    //         ['IsPublished' => true, 'IsPublic' => true], // Pour sélectionner les users publics et publiés
    //         ['CreatedAt' => 'DESC'], // Pour trier
    //         9 // Pour limiter l'affichage
    //     );

    //     return $this->render('home/home.html.twig', [
    //         'users' => $users
    //     ]);
    // }
}
