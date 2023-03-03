<?php
// src/Controller/TaskController.php
namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
// ...

class TaskController extends AbstractController
/**
 * Controller for action responsable for converting specified amount. 
 * Creating object task, function also are creating object form, collecting data from submited form, making request to the api and calculate siecified amount with specified rules
 *  and rendering results into view
 */
{
    public function convert(Request $request): Response
    
    { 
        // creates a task object and initializes some data for this example
        $task = new \App\Entity\Task();
        $converted=false;
        $values=false;
          $form = $this->createFormBuilder($task)
            ->add('amount', TextType::class)
            ->add('type',ChoiceType::class,
                    ['choices'=>[
                        'SGD to PLN'=>0,
                        'PLN to SGD'=>1]
                        ]) //(['SGD'=>'SGD to PLN','PLN'=>'PLN to SGD']))
            ->add('save', SubmitType::class, ['label' => 'Convert'])
            ->getForm();
           $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                    $task = $form->getData();
                    $converted=true;
                    $task->apirequestLocal();
                    $values[0]=$task->result;
                    $values[1]=$task->desc;
            }
          
        return $this->render('task/new.html.twig', [
            'form' => $form->createView(),
            'task' => $task,
            'converted'=>$converted,
            'values'=>$values
        ]);
    }
    
}
