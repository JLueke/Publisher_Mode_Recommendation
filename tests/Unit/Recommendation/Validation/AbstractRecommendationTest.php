<?php

namespace Unit\Publisher\Mode\Recommendation\Validation;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\ConstraintValidatorFactory;
use Publisher\Mode\Recommendation\AbstractRecommendation;

abstract class AbstractRecommendationTest extends \PHPUnit_Framework_TestCase
{
    
    public function setUp()
    {
        $builder = Validation::createValidatorBuilder();
        $builder->setConstraintValidatorFactory(new ConstraintValidatorFactory());
        $builder->addObjectInitializers(array());
        $paths = $this->getYamlValidationPaths();
        $paths[] = __DIR__ . '/../../Resources/config/validation.yaml';
        $builder->addYamlMappings($paths);
        $builder->addMethodMapping('loadValidatorMetadata');
        
        $this->validator = $builder->getValidator();
    }
    
    /**
     * @dataProvider getExceededMessageData
     */
    public function testExceededMessage($data)
    {
        $recommendation = $this->createRecommendation();
        
        $recommendation->setMessage($data['message']);
        $recommendation->setUrl($data['url']);
        $recommendation->setTitle($data['title']);
        
        $errors = $this->validator->validate($recommendation);
        
        $this->assertTrue(count($errors) > 0);
    }
    
    /**
     * Data provider for testExceededMessage.
     * 
     * @return array
     */
    public abstract function getExceededMessageData();
    
    /**
     * An instance of a Recommendation entity that shall be tested.
     * 
     * @return AbstractRecommendation
     */
    protected abstract function createRecommendation();
    
    /**
     * Returns the paths of the yaml validation files
     * that specify the validation for a certain Recommendation entity.
     * 
     * @return string[]
     */
    protected abstract function getYamlValidationPaths();
    
}