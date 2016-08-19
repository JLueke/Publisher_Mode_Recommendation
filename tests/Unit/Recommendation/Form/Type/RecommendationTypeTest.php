<?php

namespace Unit\Publisher\Mode\Recommendation\Form\Type;

use Publisher\Mode\Recommendation\Form\Type\RecommendationType;
use Symfony\Component\Form\Test\TypeTestCase;

class RecommendationTypeTest extends TypeTestCase
{
    
    /**
     * @dataProvider getFormData
     */
    public function testSimpleSubmitWithoutEntity($formData)
    {
        $form = $this->createForm();
        
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        var_dump($form->getData());
        $this->assertEquals($formData, $form->getData());
    }
    
    public function getFormData()
    {
        return array(
            array(
                array(
                    'message' => 'foo',
                    'url' => 'http://www.example.com',
                    'title' => 'bar',
                    'date' => null
                ),
                array(
                    'message' => 'foo',
                    'url' => 'http://www.example.com',
                    'title' => 'bar',
                    'date' => 1471626215
                )
            )
        );
    }
    
    protected function createForm(array $options = array())
    {
        return $this->factory->create(RecommendationType::class, null, $options);
    }
    
}