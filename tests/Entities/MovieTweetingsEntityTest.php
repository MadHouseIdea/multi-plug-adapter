<?php

namespace MadHouseIdeas\Lib\MultiPlugAdapter\Tests;

use PHPUnit\Framework\TestCase;

use MadHouseIdeas\Lib\MultiPlugAdapter\Entities\MovieTweetingsEntity;

class MovieTweetingsEmtityTest extends TestCase
{

    /**
     * @test
     */
    public function shouldSetAnGetMovieIdValueOnEntity()
    {
        $entity = new MovieTweetingsEntity;
        $entity->setMovieId(1234);

        $this->assertEquals(1234, $entity->getMovieId());
    }

    /**
     * @test
     */
    public function shouldSetAnGetMovieTitleValueOnEntity()
    {
        $entity = new MovieTweetingsEntity;
        $entity->setMovieTitle("Movie Title");

        $this->assertEquals("Movie Title", $entity->getMovieTitle());
    }

    /**
     * @test
     */
    public function shouldSetAnGetMovieYearValueOnEntity()
    {
        $entity = new MovieTweetingsEntity;
        $entity->setMovieYear(2017);

        $this->assertEquals(2017, $entity->getMovieYear());
    }

    /**
     * @test
     */
    public function shouldSetAnGetMovieGenresValueOnEntity()
    {
        $entity = new MovieTweetingsEntity;
        $entity->setGenres(['Action', 'Crime']);

        $this->assertEquals(['Action', 'Crime'], $entity->getGenres());
    }
}
