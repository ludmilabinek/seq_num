<?php 
// src/AppBundle/Entity/Sequence.php
namespace AppBundle\Entity;

class Sequence
{
    protected $n;
    protected $arr_elements;

    public function __construct($n) {
        $this->n = $n;
        $this->arr_elements = array();
    }
    
    public function getN() {
        return $this->n;
    }
    
    public function getArrElements() {
        return $this->arr_elements;
    }
    
    public function generateElements() {
        $a = array(0=>0, 1=>1);
        if($this->n>=1) {
            for($i=2; $i<=$this->n; $i++) {
                if($i%2===0) {
                    $a[$i] = $a[$i/2];
                }
                else {
                    $a[$i] = $a[($i-1)/2] + $a[(($i-1)/2)+1];
                }
            }
        }
        $this->arr_elements = $a;
    }
    
    public function coutMaxValue() {
        return max($this->arr_elements);
    }
}