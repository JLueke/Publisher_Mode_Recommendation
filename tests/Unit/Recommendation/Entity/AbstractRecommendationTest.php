<?php

namespace Unit\Publisher\Mode\Recommendation\Entity;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\ConstraintValidatorFactory;
use Symfony\Component\Validator\Mapping\Factory\LazyLoadingMetadataFactory;
use Symfony\Component\Validator\Mapping\Loader\StaticMethodLoader;
use Publisher\Mode\Recommendation\Entity\AbstractRecommendation;

abstract class AbstractRecommendationTest extends \PHPUnit_Framework_TestCase
{
    
    public function setUp()
    {
        $builder = Validation::createValidatorBuilder();
        $builder->setConstraintValidatorFactory(new ConstraintValidatorFactory());
        $builder->addObjectInitializers(array());
        $builder->addMethodMapping('loadValidatorMetadata');
        
        $this->validator = $builder->getValidator();
    }
    
    /**
     * @dataProvider getValidData
     */
    public function testValidMessage(array $data)
    {
        $recommendation = $this->createRecommendation();
        
        $recommendation->setMessage($data['message']);
        $recommendation->setUrl($data['url']);
        $recommendation->setTitle($data['title']);
        $recommendation->setDate($data['date']);
        
        $errors = $this->validator->validate($recommendation);
        
        $this->assertEquals(0, count($errors));
    }
    
    /**
     * @dataProvider getInvalidData
     */
    public function testInvalidData(array $data, int $numberOfErrors)
    {
        $recommendation = $this->createRecommendation();
        
        $recommendation->setMessage($data['message']);
        $recommendation->setUrl($data['url']);
        $recommendation->setTitle($data['title']);
        $recommendation->setDate($data['date']);
        
        $errors = $this->validator->validate($recommendation);
        
        $this->assertEquals($numberOfErrors, count($errors));
    }
    
    /**
     * @dataProvider getExeecedMessageData
     */
    public function testExeecedMessage($data)
    {
        $recommendation = $this->createRecommendation();
        
        $recommendation->setMessage($data['message']);
        $recommendation->setUrl($data['url']);
        $recommendation->setTitle($data['title']);
        $recommendation->setDate($data['date']);
        
        $errors = $this->validator->validate($recommendation);
        
        $this->assertTrue(count($errors) > 0);
    }
    
    public abstract function getValidData();
    
    public abstract function getInvalidData();
    
    /**
     * @return AbstractRecommendation
     */
    protected abstract function createRecommendation();
    
}