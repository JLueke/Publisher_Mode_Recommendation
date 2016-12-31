<?php

namespace Publisher\Mode\Recommendation;

use Publisher\Mode\AbstractEntryModeEntity;

abstract class AbstractRecommendation extends AbstractEntryModeEntity
{
    
    /**
     * @var string 
     */
    protected $message;
    /**
     * @var string 
     */
    protected $url;
    /**
     * @var string 
     */
    protected $title;
    
    /**
     * @param string[] $content contains a message, url and title
     */
    public function __construct(array $content = array())
    {
        $this->message = isset($content['message']) ? $content['message'] : '';
        $this->url = isset($content['url']) ? $content['url'] : '';
        $this->title = isset($content['title']) ? $content['title'] : '';
    }
    
    /**
     * @param string $message
     * 
     * @return void
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
    }
    
    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
    
    /**
     * @param string $url
     * 
     * @return void
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }
    
    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
    
    /**
     * @param string $title
     * 
     * @return void
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }
    
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Returns the complete message like the Entry would create it.
     * A message can contain more parts than the 'message' field itself.
     * 
     * Example:
     * The TwitterUserRecommendation combines the parameters
     * message, url and title to a single message.
     * The FacebookUserRecommendation combines only the parameters message and title,
     * but sends the url in a seperate parameter called 'link'.
     * Thus the message payload for FacebookUserRecommendation
     * would only contain the message and the title, but not the url.
     * 
     * @return string
     */
    public abstract function getMessagePayload();
    
}