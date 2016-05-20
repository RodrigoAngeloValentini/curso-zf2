<?php

namespace SON\Controller;

use SONBase\Test\ControllerTestCase;
use SON\Controller\IndexController;
use SON\Service\Task;
use Zend\Http\Request;
use Zend\Stdlib\Parameters;
use Zend\View\Renderer\PhpRenderer;

class IndexControllerTest extends ControllerTestCase 
{
    protected $controllerFQDN = 'SON\Controller\IndexController';
    protected $controllerRoute = 'son-home';
    
    public function test_erro404()
    {
        $this->routeMatch->setParam('action','actionNaoExiste');
        $result = $this->controller->dispatch($this->request);
        
        $response = $this->controller->getResponse();
        
        $this->assertEquals(404,$response->getStatusCode());
    }
    
    public function test_indexAction()
    {
        $class = new Task($this->getEm());
        
        $data = array(
          'nome' => 'Tarefa',
          'descricao' => 'descricao',
            'status' => true
        );
        
        $result = $class->insert($data);
        
        $data['nome'] = "Tarefa 2";
        $result = $class->insert($data);
        
        $this->routeMatch->setParam('action','index');
        $result = $this->controller->dispatch($this->request,$this->response);
        
        // testar o codigo 200
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        
        // verifica se esta retornando viewmodel
        $this->assertInstanceOf('Zend\View\Model\ViewModel',$result);
        
        // testa variavel enviada na viewmodel
        $var = $result->getVariables();
        $this->assertArrayHasKey('tasks',$var);
        
        $cData = $var['tasks'];
        $this->assertEquals('Tarefa',$cData[0]->getNome());
        $this->assertEquals('Tarefa 2',$cData[1]->getNome());
        
        
    }
}
