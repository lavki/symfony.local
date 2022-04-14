<?php

namespace App\DTO;

class FilterFormDTO 
{
    public string $location;
    public ?\DateTime $dateFrom;
    public ?\DateTime $dateTo;

    public function __construct(?string $location = null, ?\DateTime $dateFrom = null, ?\DateTime $dateTo = null)
    {
        $this->location = $location;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
    }

}