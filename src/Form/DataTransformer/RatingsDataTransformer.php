<?php

namespace App\Form\DataTransformer;

use App\Form\Model\Ratings;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\DataTransformerInterface;

class RatingsDataTransformer implements DataTransformerInterface
{
    /** @param Collection $value */
    public function transform($value)
    {
        //$data = new Ratings();
        //$data->setCollection($value);

        return $value;
    }

    /**
     * @param Ratings $value
     */
    public function reverseTransform($value)
    {
        //return $value->getCollection();
        return $value;
    }
}
