<?php

namespace Unit\Publisher\Mode\Recommendation;

use Publisher\Mode\Recommendation\AbstractRecommendation;

class AbstractRecommendationTest extends \PHPUnit_Framework_TestCase
{
    
    public function testGetterAndSetter()
    {
        $entity = $this->createRecommendation();
        
        $message = 'message';
        $url = 'http://www.example.com';
        $title = 'Title';
        
        $entity->setMessage($message);
        $entity->setUrl($url);
        $entity->setTitle($title);
        
        $this->assertEquals($message, $entity->getMessage());
        $this->assertEquals($url, $entity->getUrl());
        $this->assertEquals($title, $entity->getTitle());
    }
    
    /**
     * An instance of a Recommendation entity that shall be tested.
     * 
     * @param array $content
     * 
     * @return AbstractRecommendation
     */
    protected function createRecommendation(array $content = array())
    {
        return $this->getMockForAbstractClass(
            'Publisher\Mode\Recommendation\AbstractRecommendation',
            array($content)
        );
    }
    
}