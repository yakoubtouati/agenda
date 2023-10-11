<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/', name: 'app.index',methods:["GET"])]
    public function index(): Response
    {
        return $this->render('contact/index.html.twig');
    }
    
    #[Route('/contact/create', name: 'app.create', methods:['GET', 'POST'])]
    public function create(Request $request): Response
    {
        // Créer une nouvelle instance de Contact
        $contact = new Contact();

        // Créer le formulaire d'ajout des données du nouveau contact
        $form = $this->createForm(ContactFormType::class, $contact);

        // Associons les données de la requête au formulaire
        $form->handleRequest($request);

        // Si le formulaire est soumis et qu'il est valide
        if ( $form->isSubmitted() && $form->isValid() ) 
        {
            // Demander au gestionnaire des entités de préparer la requête d'insertion des données en base

            // D'exécuter la requête

            // Générer le message flash de succès

            // Effectuer une redirection vers la page d'accueil
        }

        return $this->render("contact/create.html.twig", [
            "form" => $form->createView()
        ]);
    }
}
