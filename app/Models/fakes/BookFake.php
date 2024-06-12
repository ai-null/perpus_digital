<?php

namespace App\Models\fakes;

use Faker\Provider\Base as BaseFaker;

class BookFake extends BaseFaker
{
    public function bookTitle($nbWords = 5)
    {
        $sentence = $this->generator->sentence($nbWords);
        return substr($sentence, 0, strlen($sentence) - 1);
    }

    public function isbn()
    {
        return $this->generator->ean13();
    }
}
