<?php
namespace tests\Api;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolverInterface;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Symfony\Component\Routing;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

/**
 * 
 * Tests for an api 
 *
 * @author es
 */
class ApiTest extends TestCase{

    /*
     * Value of amount to make calculations
     */
    protected $amount=10;
    /*
     * Expected value for conversion sgd to pln
     */
    protected $result_sgd_to_pln=32.9;
    /*
     * Expected value for conversion from pln to sgd
     */
    protected $result_pln_to_sgd=3;
    /**
     * Testing method GET for conversion SGD to PLN
     */
    public function testGetSgdToPln(){
        $task = new \App\Entity\Task;
        $task->amount=$this->amount;
        $sgd_to_pln=0;
        $task->type=$sgd_to_pln ; 
        $task->apirequestLocal();
        $this->assertEquals($this->result_sgd_to_pln,$task->result);
                        
    }
    /**
     * Testing method GET in conversion PLN to SGD
     */
    public function testGetPlnToSGD(){
        $task = new \App\Entity\Task;
        $task->amount=$this->amount;
        $pln_to_sgd=1;
        $task->type=$pln_to_sgd;
        $task->apirequestLocal();
        $this->assertEquals($this->result_pln_to_sgd,$task->result);
    }
            
}
