<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Sequences;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class NumSeqController extends Controller
{
    /**
     * @Route("/numseq/form")
     */
    public function newForm(Request $request) {
        $error = "";
        $arr_result = array();
        $form = $this->createCustomForm();
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $arr_seq = $form->getData();
            if(isset($arr_seq['n'])) {
                $arr_result = array();
                $arr_n = explode(PHP_EOL,$arr_seq['n']);
                
                $seqs = new Sequences($arr_n);
                $arr_result = $seqs->countMaxSequences();
                
                //after success - cleaning the form
                unset($form);
                $form = $this->createCustomForm();
                
            }
        }
        
        return $this->render('default/form.html.twig', array(
            'form' => $form->createView(), 'error' => $error, 'result' => $arr_result
        ));
    }
    
    private function createCustomForm() {
        $form = $this->createFormBuilder()
        ->add('n', TextareaType::class, array('required' => true, 'attr' => array('rows' => '10')))
        ->add('save', SubmitType::class, array('label' => 'Generate Result'))
        ->getForm();
        return $form;
    }
 
}