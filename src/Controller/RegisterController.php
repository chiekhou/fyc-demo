<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use App\Security\LoginAuthenticator;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register( 
        Request $request,
    UserPasswordHasherInterface $userPasswordHasher,
    UserAuthenticatorInterface $userAuthenticator,
    LoginAuthenticator $authenticator,
    EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser()) {
            $this->addFlash('success', 'Le formulaire a été enregistré avec succès.');
            return $this->redirectToRoute('app_dashboard');
        }

        $user = new User();
        $form = $this->createForm(RegisterFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //  encode the plain password
 $user->setPassword(
    $userPasswordHasher->hashPassword(
        $user,
        $form->get('plainPassword')->getData()
    )
);

// persist user
$entityManager->persist($user);
$entityManager->flush();
            }

return 
$this->render('register/index.html.twig', [
    'registerForm' => $form->createView(),
]);
$userAuthenticator->authenticateUser(
    $user,
    $authenticator,
    $request
);
        
}
}
