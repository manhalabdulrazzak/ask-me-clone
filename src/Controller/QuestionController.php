<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Question;
use App\Form\AnswerType;
use App\Form\QuestionType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuestionController extends AbstractController
{
    /**
     * @Route("/question/{id}", name="app_question", requirements={"id"="\d+"})
     * @param Question $question
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function index(Question $question, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $renderedForm = null;
        if($this->isGranted("IS_AUTHENTICATED_FULLY"))
        {
            $answer = new Answer();
            $form = $this->createForm(AnswerType::class, $answer);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                $answer->setUser($this->getUser());
                $answer->setQuestion($question);

                $entityManager->persist($answer);
                $entityManager->flush();
                return $this->redirectToRoute("app_question", ['id' => $question->getId()]);
            }

            $renderedForm = $form->createView();
        }

        $question->setViews($question->getViews() + 1);

        $entityManager->persist($question);
        $entityManager->flush();

        return $this->render('question/index.html.twig', [
            'question' => $question,
            'answerForm' => $renderedForm
        ]);
    }


    /**
     * @Route("/question/ask", name="app_question_ask")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function askQuestion(Request $request)
    {
        $question = new Question();
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $question->setUser($this->getUser());
            $question->setCreated(new \DateTime());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($question);
            $entityManager->flush();
            return $this->redirectToRoute("app_question", ['id' => $question->getId()]);
        }

        return $this->render('question/ask.html.twig', [
            'questionForm' => $form->createView()
        ]);
    }
}
