<?php

namespace SocialCar\CoreBundle\Tests\Abstracts;

class AbstractTest extends \PHPUnit_Framework_TestCase
{
    protected function mockObject($class, $params = array())
    {
        $mocked = $this->getMockBuilder($class)->disableOriginalConstructor()->getMock();
        foreach( $params as $param )
        {
            if ( isset($param['return_self']) and $param['return_self'] == true )
            {
                $param['return'] = $mocked;
            }
            $mocked->expects($this->exactly($param['times']))
                ->method($param['method'])
                ->willReturn($param['return']);
        }
        return $mocked;
    }
    
    protected function mockObjectWith($class, $params = array())
    {
        $mocked = $this->getMockBuilder($class)->disableOriginalConstructor()->getMock();
        foreach( $params as $param )
        {
            $mocked->expects($this->exactly($param['times']))
                ->method($param['method'])
                ->with($param['with'])
                ->willReturn($param['return']);
        }
        return $mocked;
    }
}