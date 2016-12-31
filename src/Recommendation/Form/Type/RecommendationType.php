<?php

namespace Publisher\Mode\Recommendation\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class RecommendationType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, $this->getTitleConfig())
            ->add('message', TextareaType::class, $this->getMessageConfig())
            ->add('url', UrlType::class, $this->getUrlConfig())
        ;
    }
    
    protected function getMessageConfig()
    {
        return array(
            'required' => true
        );
    }
    
    protected function getUrlConfig()
    {
        return array(
            'required' => false,
            'empty_data' => ''
        );
    }
    
    protected function getTitleConfig()
    {
        return array(
            'required' => false,
            'empty_data' => ''
        );
    }
    
}