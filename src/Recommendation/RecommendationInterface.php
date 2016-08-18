<?php

namespace Publisher\Mode\Recommendation;

interface RecommendationInterface
{
    
    public function setRecommendationParameters(
        string $message,
        string $url = '',
        string $title = '',
        $date = null
    );
}

