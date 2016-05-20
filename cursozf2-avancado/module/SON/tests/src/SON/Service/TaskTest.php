<?php

namespace SON\Service;

use SONBase\Test\TestCase;

class TaskTest extends TestCase
{
    public function test_verifica_se_classe_task_existe()
    {
        $class = class_exists("\\SON\\Service\\Task");
        $this->assertTrue($class);
    }
    
    public function test_verifica_se_a_classe_tem_o_atributo_em()
    {
        $this->assertClassHasAttribute("em","\\SON\\Service\\Task");
    }
    
    public function test_verifica_metodo_getEm()
    {
        $class = new Task($this->getEmMock());
        $em = $class->getEm();
        
        $this->assertInstanceOf("\\Doctrine\\ORM\\EntityManager",$em);
    }
    
    public function test_verifica_insert()
    {
        $class = new Task($this->getEmMock());
        
        $data = array(
          'nome' => 'Tarefa 1',
          'descricao' => 'Descricao da tarefa',
          'status' => false
        );
        
        $result = $class->insert($data);
        $this->assertInstanceOf("\SON\Entity\Task",$result);
    }
    
    
    /**
    * @expectedException 	InvalidArgumentException
    * @expectedExceptionMessage	A key ID é obrigatória dentro do array
    */
    public function test_verifica_se_id_esta_no_array_do_update()
    {
        $class = new Task($this->getEmMock());
        
        $data = array(
          'nome' => 'Tarefa 1',
          'descricao' => 'Descricao da tarefa',
          'status' => false
        );
        
        $result = $class->update($data);
    }
    
    public function test_verifica_retorno_do_update()
    {
        $data = array(
          'id' => 1,
          'nome' => 'Tarefa 1',
          'descricao' => 'Descricao da tarefa',
          'status' => false
        );
        
        $emMock = $this->getEmMock();
        
        $emMock->expects($this->any())
                ->method('getReference')
                ->will($this->returnValue(new \SON\Entity\Task($data)));
        
        $class = new Task($emMock);
        $result = $class->update($data);
        
        $this->assertInstanceOf("\SON\Entity\Task",$result);
       
       }
       
    /**
    * @expectedException 	InvalidArgumentException
    * @expectedExceptionMessage	O campo ID deve ser numérico
    */
    public function test_verifica_se_id_e_inteiro_no_metodo_delete()
    {
        $class = new Task($this->getEmMock());
        $result = $class->delete('oi');
    }
    
    public function test_verifica_retorno_metodo_delete()
    {
        $class = new Task($this->getEmMock());
        $result = $class->delete(1);
        
        $this->assertEquals(1, $result);
    }
    
    private function getEmMock()
    {
        $emMock = $this->getMock('\Doctrine\ORM\EntityManager',
                array('persist','flush','getReference','remove'),array(),'',false);
        
        $emMock->expects($this->any())
                ->method('persist')
                ->will($this->returnValue(null));
        
        $emMock->expects($this->any())
                ->method('remove')
                ->will($this->returnValue(null));
        
        $emMock->expects($this->any())
                ->method('flush')
                ->will($this->returnValue(null));
        
        return $emMock;
    }
}
