<?php

namespace MadHouseIdeas\Lib\MultiPlugAdapter\Contracts;

interface RequestParamsInterface
{
    public function getRoute();
    public function getQuery();
}

