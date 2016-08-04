<?php

namespace Unit\Publisher\Mode\Recommendation;

abstract class RecommendationInterfaceTest extends \PHPUnit_Framework_TestCase
{
    
    protected function getEntry(array $parameters = array())
    {
        $entryName = $this->getEntryName();
        $entry = new $entryName($parameters);
        
        return $entry;
    }
    
    protected abstract function getEntryName();
    
    public abstract function getValidRecommendationParameters();
    
    public abstract function getRecommendationParametersAndResult();
    
    /**
     * @dataProvider getValidRecommendationParameters
     */
    public function testSuccessfulRecommandation($message, $title, $url, $date)
    {
        $this->entry = $this->getEntry();
        
        $exception = null;
        try {
            $this->entry->setRecommendationParameters($message, $title, $url, $date);
        } catch (Exception $exception) {}
        
        $this->assertNull($exception);
    }
    
    /**
     * @dataProvider getRecommendationParametersAndResult
     */
    public function testObtainedRecommendationBody($message, $url, $title, $date, array $results)
    {
        $this->entry = $this->getEntry();
        
        $this->entry->setRecommendationParameters($message, $url, $title, $date);
        $body = $this->entry->getRequest()->getBody();
        
        foreach($results as $parameter => $result) {
            $this->assertEquals($result, $body[$parameter]);
        }
    }
}