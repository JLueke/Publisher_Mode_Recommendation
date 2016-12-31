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
        $builder->addYamlMappings($this->getYamlValidationPaths());
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
     * Test the validation given by the EntryModeEntity parent.
     * 
     * @dataProvider getValidationTestData
     */
    public function testValidation(array $content, $numberOfErrors)
    {
        $recommendation = $this->createRecommendation($content);
        
        $errors = $this->validator->validate($recommendation);
        
        $this->assertEquals($numberOfErrors, count($errors));
    }
    
    /**
     * Returns data containing a test content
     * and the expected number of validation error.
     * 
     * @return array
     */
    public function getValidationTestData()
    {
        $testData = array(
            array(array(), 1),
            array(array('message' => 'Foo', 'url' => 'http://www.example.com'), 0),
            array(array('message' => 'Foo', 'url' => 'no valid URL'), 1)
        );
        
        return $testData;
    }
    
    /**
     * An instance of a Recommendation entity that shall be tested.
     * 
     * @param array $content
     * 
     * @return AbstractRecommendation
     */
    protected abstract function createRecommendation(array $content = array());
    
    /**
     * Returns the paths of the yaml validation files.
     * 
     * @return string[]
     */
    protected function getYamlValidationPaths()
    {
        return array(__DIR__ . '/../../../../Resources/config/validation.yml');
    }
    
}