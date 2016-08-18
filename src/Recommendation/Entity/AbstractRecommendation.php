<?php

namespace Publisher\Mode\Recommendation\Entity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

abstract class AbstractRecommendation
{
    
    protected $message;
    protected $url;
    protected $title;
    protected $date;
    
    public function __construct()
    {
        $this->message = '';
        $this->url = '';
        $this->title = '';
        $this->date = null;
    }
    
    public function getDataAsArray()
    {
        return array(
            'message' => $this->message,
            'url'     => $this->url,
            'title'   => $this->title,
            'date'    => $this->date
        );
    }
    
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        static::addMessageConstraints($metadata);
        static::addUrlConstraints($metadata);
        static::addTitleConstraints($metadata);
        static::addDateConstraints($metadata);
        
        $metadata->addConstraint(new Assert\Callback('validateMessageLength'));
    }
    
    protected static function addMessageConstraints(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('message', new Assert\NotBlank());
    }
    
    protected static function addUrlConstraints(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('url', new Assert\Url());
    }
    
    protected static function addTitleConstraints(ClassMetadata $metadata)
    {
        
    }
    
    protected static function addDateConstraints(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('date', new Assert\Blank(array(
            'message' => 'recommendation.date.notsupported'
        )));
    }
    
    /**
     * Validates if the message doesn't exceed
     * the maximum, allowed number of characters.
     * 
     * @param ExecutionContextInterface $context
     * @param mixed $payload
     * 
     * @return void
     */
    public function validateMessageLength(
        ExecutionContextInterface $context,
        $payload
    ) {
        // maximum, allowed number of characters
        $max = $this->getMaxLengthOfMessage();
        
        $message = $this->createCompleteMessage();
        
        if (strlen($message) > $max) {
            $context->buildViolation($this->getMaxLengthViolationMessage($max))
                ->atPath('message')
                ->addViolation();
        }
    }
    
    public function setMessage(string $message)
    {
        $this->message = $message;
    }
    
    public function getMessage()
    {
        return $this->message;
    }
    
    public function setUrl(string $url)
    {
        $this->url = $url;
    }
    
    public function getUrl()
    {
        return $this->url;
    }
    
    public function setTitle(string $title)
    {
        $this->title = $title;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function setDate($date)
    {
        $this->date = $date;
    }
    
    public function getDate()
    {
        return $this->date;
    }
    
    /**
     * Returns how many characters are allowed in a message at maximum.
     * A message can be contain more parts than the 'message' field itself.
     * 
     * @return int
     */
    protected abstract function getMaxLengthOfMessage();
    
    /**
     * Returns the complete message like the Entry would create it.
     * A message can be contain more parts than the 'message' field itself.
     * 
     * @return string
     */
    protected abstract function createCompleteMessage();
    
    /**
     * Returns the violation message for exceeding messages.
     * 
     * @param int $max the maximum, allowed number of characters
     * 
     * @return string
     */
    protected function getMaxLengthViolationMessage(int $max)
    {
        return "Title, message and URL combined shouldn't exceed $max characters.";
    }
    
}