<?php

namespace MadHouseIdeas\Lib\MultiPlugAdapter\Adapters;

class MovieTweetingsAdapter
{
    protected $fieldSeparator = '::';
    protected $genreSeparator = '|';
    protected $entity;

    public function getFieldSeparator()
    {
        return $this->fieldSeparator;
    }

    public function getGenreSeparator()
    {
        return $this->genreSeparator;
    }

    public function getEntity()
    {
        return $this->entity;
    }

    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    public function __invoke($string)
    {
        return array_map(
            [$this, 'populate'],
            array_filter(explode(PHP_EOL, $string))
        );
    }

    protected function populate($line)
    {
        if (empty($line)) {
            return false;
        }
        $fields = explode($this->getFieldSeparator(), $line);
        preg_match("/(.*)\((.*)\)/", $fields[1], $titleYear);

        $genres = array_filter(
            explode($this->getGenreSeparator(), $fields[2])
        );

        return $this->getEntity()
            ->newInstance()
                ->setMovieId($fields[0])
                ->setMovieTitle(trim($titleYear[1]))
                ->setMovieYear(trim($titleYear[2]))
                ->setGenres($genres);
    }
}

