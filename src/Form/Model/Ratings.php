<?php

namespace App\Form\Model;

use Doctrine\Common\Collections\Collection;

class Ratings
{
    private Collection $collection;

    public function getCollection(): Collection
    {
        return $this->collection;
    }

    public function setCollection(Collection $collection): void
    {
        $this->collection = $collection;
    }
}
