<?php

namespace MadHouseIdeas\Lib\MultiPlugAdapter\Entities;

class MovieTweetingsEntity
{
    protected $movieId;
    protected $movieTitle;
    protected $movieYear;
    protected $genres;

    public function newInstance()
    {
        return new self;
    }

    public function setMovieId($movieId)
    {
        $this->movieId = $movieId;
        return $this;
    }

    public function setMovieTitle($movieTitle)
    {
        $this->movieTitle = $movieTitle;
        return $this;
    }

    public function setMovieYear($movieYear)
    {
        $this->movieYear = $movieYear;
        return $this;
    }

    public function setGenres(Array $genres)
    {
        $this->genres = $genres;
        return $this;
    }

    public function getMovieId()
    {
        return $this->movieId;
    }

    public function getMovieTitle()
    {
        return $this->movieTitle;
    }

    public function getMovieYear()
    {
        return $this->movieYear;
    }

    public function getGenres()
    {
        return $this->genres;
    }
}

