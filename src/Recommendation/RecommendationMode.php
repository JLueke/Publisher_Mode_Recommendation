<?php

namespace Publisher\Mode\Recommendation;

use Publisher\Mode\ModeInterface;
use Publisher\Entry\EntryInterface;
use Publisher\Mode\Recommendation\RecommendationInterface;
use Publisher\Mode\Exception\InterfaceRequiredException;
use Publisher\Helper\Validator;

class RecommendationMode implements ModeInterface
{
    
    /**
     * @{inheritdoc}
     */
    public static function checkImplementsMode(EntryInterface $entry)
    {
        if (!($entry instanceof RecommendationInterface)) {
            throw new InterfaceRequiredException(
                'Entry '.$entry::getId().' must support RecommendationInterface'
            );
        }
    }
    
    /**
     * @{inheritdoc}
     */
    public static function checkContent(array $content)
    {
        Validator::checkRequiredParametersAreSet($content, array('message'));
        
        $required = array('title', 'url', 'date');
        Validator::checkRequiredParameters($content, $required);
    }
    
    /**
     * @{inheritdoc}
     */
    public static function fillEntry(EntryInterface $entry, array $content)
    {
        $entry->setRecommendationParameters(
            $content['message'],
            $content['url'],
            $content['title'],
            $content['date']
        );
    }
    
}