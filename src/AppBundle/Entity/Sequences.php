<?php
// src/AppBundle/Entity/Sequences.php
namespace AppBundle\Entity;

use AppBundle\Entity\Sequence;

class Sequences {
    
    /**
     * @var Array Sequence
     */
    private $arr_sequences;
    
    public function __construct($arr_n) {
        $arr_n = array_slice($arr_n,0,10);
        foreach($arr_n as $n) {
            $seq = new Sequence($n);
            if(preg_match('/[0-9]+/',$n) && $n>=1 && $n<=99999) {
                $seq->generateElements();
            }
            $this->addSequence($seq);
        }
    }
    
    protected function addSequence($seq) {
        $this->arr_sequences[] = $seq;
    }
    
    public function countMaxSequences() {
        foreach($this->arr_sequences as $seq) {
            if(count($seq->getArrElements())>0) {
                $result = $seq->coutMaxValue();
            }
            else {
                $result = "wrong data";
            }
            $arr_result[] = array("n" => $seq->getN(), "result" => $result);
        }
        return $arr_result;
    }
}