<?php
namespace App\Controller\User;

use App\Entity\Users;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserController extends AbstractController
{
    /**
     *      * @Route("/product", name="product")
     *           */
    public function index()
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        //         // or you can add an argument to your action: index(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $user = new Users();
        $user->setFullName('Sample Name');
        $user->setAge(12);
        $user->setGender('Male');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($user);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$user->getId());
    }

    /**
     *@Route("/product/{id}", name="product_show")
     *
     */
    public function show($id)
    {
        $user = $this->getDoctrine()
            ->getRepository(Users::class)
            ->find($id);
        if (!$user) {
            throw $this->createNotFoundException(
                'No no'
            );
        }

        return new Response('Check out this greate user ' .$user->getFullName());

    }

    /**
     *@Route("/add", name="add_user")
     *
     */
    public function addUser(Request $request)
    {
        $user = new Users();
        $form = $this->createFormBuilder($user)
            ->add('full_name', TextType::class)
            ->add('gender', TextType::class)
            ->add('age', IntegerType::class)
            ->add('save', SubmitType::class, ['label' => 'Create User'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();
            return $this->redirectToRoute('add_user');
        }

        return $this->render('user/add_user.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
