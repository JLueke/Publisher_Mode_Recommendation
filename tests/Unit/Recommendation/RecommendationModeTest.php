<?php

namespace Unit\Publisher\Mode\Recommendation;

use Unit\Publisher\Mode\AbstractModeTest;
use Publisher\Mode\Recommendation\RecommendationMode;
use Publisher\Entry\EntryInterface;

class RecommendationModeTest extends AbstractModeTest
{
    
    protected function checkImplementsMode(EntryInterface $entry)
    {
        RecommendationMode::checkImplementsMode($entry);
    }
    
    protected function getTestEntry()
    {
        return $this->getMockForAbstractClass(
            'Mock\\Publisher\\Mode\\Recommendation\\MockUser'
        );
    }
    
    protected function checkContent(array $content)
    {
        RecommendationMode::checkContent($content);
    }
    
    public function getTestContent()
    {
        return array(
            array(
                array(
                    'message' => 'foo',
                    'url' => null,
                    'title' => null,
                    'date' => null
                )
            ),
            array(
                array(
                    'message' => 'foo',
                    'url' => 'foo',
                    'title' => 'foo',
                    'date' => 1469713699
                )
            )
        );
    }
    
}