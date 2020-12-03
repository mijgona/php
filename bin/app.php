<?php
    class Calculate {
        public $number1;
        public $number2;
        public $operation;
        public $result;

        public function run()
        {
            switch ($this->operation) {
                case "+": 
                    $this->getSum();
                break;                
                case "-": 
                    $this->getSub();
                break;
                case "/": 
                    $this->getDivide();
                break;
                case "*": 
                    $this->getMultiply();
                break;
            }
        }

        public function getSum(){
            $this->result=$this->number1+$this->number2;
        }
        public function getSub(){
            $this->result=$this->number1-$this->number2;
        }
        public function getDivide(){
            $this->result=$this->number1/$this->number2;
        }
        public function getMultiply(){
            $this->result=$this->number1*$this->number2;
        }

    }
    echo 'Введите тип оперции';
    $operation = trim((fgets(STDIN)));
    echo 'Введите имя файла';
    $file=trim((fgets(STDIN)));
    //$file="input\input.txt";
    $fd = fopen($file, 'r') or die("не удалось открыть файл");
    $numbers = array();
    while(!feof($fd))
    {
        $numbers[]=fgets($fd);
    }
    fclose($fd);
    $calc= new Calculate();
    $negFile = fopen('output\negative.txt', 'w') or die("не удалось открыть файл");
    $posFile = fopen('output\positive.txt', 'w') or die("не удалось открыть файл");
    $calc->operation=$operation;
    for ($i=0; $i <count($numbers) ; $i++) { 
       for ($j=0; $j <count($numbers) ; $j++) { 
           if ($i<$j) {
            $calc->number1=intval($numbers[$i]);
            $calc->number2=intval($numbers[$j]);
            $calc->run();
            if ($calc->result>=0){
                fwrite($posFile,$calc->result);
                fwrite($posFile, "\n");
            } else {
                fwrite($negFile,$calc->result);                
                fwrite($negFile, "\n");
            }

           }
       }
    }
?>