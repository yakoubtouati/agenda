<?php

namespace App\Controller;

use DateTimeImmutable;
use App\Entity\Contact;
use App\Form\ContactFormType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/', name: 'app.index',methods:["GET"])]
    public function index( ContactRepository $contactRepository): Response
    {
        $contacts=$contactRepository->findAll();


        return $this->render('contact/index.html.twig',[
            "contacts"=>$contacts
        ]);
    }
    
    #[Route('/contact/create', name: 'app.create', methods:['GET', 'POST'])]
    public function create(Request $request,EntityManagerInterface $em): Response
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

            $contact->setCreatedAt(new \DateTimeImmutable());
            $contact->setUpdatedAt(new \DateTimeImmutable());

            
            // Demander au gestionnaire des entités de préparer la requête d'insertion des données en base
            $em->persist($contact);

            // D'exécuter la requête
            $em->flush();

            // Générer le message flash de succès
            $this->addFlash('succes',"Le contact a été ajouté avec succées");


            // Effectuer une redirection vers la page d'accueil
            return $this->redirectToRoute('app.index');
        }

        return $this->render("contact/create.html.twig", [
            "form" => $form->createView()
        ]);
    }

    #[Route('/contact/edit/{id}', name: 'app.edit', methods:['GET', 'POST'])]

    public function edit(Contact $contact, Request $request,EntityManagerInterface $em ):Response
    {

        $form=$this->createForm(ContactFormType::class,$contact);

        // Associons les données de la requête au formulaire
        $form->handleRequest($request);

        // Si le formulaire est soumis et qu'il est valide
        if ( $form->isSubmitted() && $form->isValid() ) 
        {

            
            $contact->setUpdatedAt(new DateTimeImmutable());

            // Demander au gestionnaire des entités de préparer la requête d'insertion des données en base
            $em->persist($contact);

            // Demander au gestionnaire des entités d'exécuter la requête
            $em->flush();

            // Générer le message flash de succès
            $this->addFlash('success', "Le contact a été Modifiée avec succès.");

            // Effectuer une redirection vers la page d'accueil
            return $this->redirectToRoute('app.index');
        }

        return $this->render("contact/edit.html.twig",[
            "form"=>$form->createView()
        ]);
    }

    
    #[Route('/contact/delete/{id}', name: 'app.delete', methods:['POST'])]
    public function delete(Contact $contact, Request $request, EntityManagerInterface $em): Response
    {
        
        if ( $this->isCsrfTokenValid("delete_contact".$contact->getId(), $request->request->get('csrf_token')) ) 
        {
            $em->remove($contact);

            $em->flush();

            $this->addFlash('success', "Le contact a été supprimé");
        }

        return $this->redirectToRoute('app.index');
    }
}
