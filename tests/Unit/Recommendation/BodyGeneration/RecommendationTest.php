<?php

namespace Unit\Publisher\Mode\Recommendation\BodyGeneration;

abstract class RecommendationTest extends \PHPUnit_Framework_TestCase
{
    
    /**
     * @param array $content
     * @param array $body
     * 
     * @dataProvider getSampleContentAndBody
     */
    public function testBodyGeneratorInterface(array $content, array $body)
    {
        $entity = $this->getTestEntity();
        
        if (isset($content['title'])) {
            $entity->setTitle($content['title']);
        }
        // message is required
        $entity->setMessage($content['message']);
        
        if (isset($content['url'])) {
            $entity->setUrl($content['url']);
        }
        
        $generatedBody = $entity->generateBody();
        
        $this->assertEquals($body, $generatedBody);
    }
    
    abstract protected function getTestEntity();
    
    abstract public function getSampleContentAndBody();
    
}