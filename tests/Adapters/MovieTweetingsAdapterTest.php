<?php

namespace MadHouseIdeas\Lib\MultiPlugAdapter\Tests;

use PHPUnit\Framework\TestCase;

use MadHouseIdeas\Lib\MultiPlugAdapter\Adapters\MovieTweetingsAdapter;
use MadHouseIdeas\Lib\MultiPlugAdapter\Entities\MovieTweetingsEntity;

class MovieTweetingsAdapterTest extends TestCase
{

    /**
     * @test
     */
    public function shouldReturnAnEmptyArrayWhenTheLineIsEmpty()
    {
        $adapter = new MovieTweetingsAdapter(new MovieTweetingsEntity);
        $this->assertEmpty($adapter(""));
    }

    /**
     * @test
     */
    public function shouldReturnAnArrayWhithMovieTweetingsEntities()
    {
        $line  = "2820852::Furious 7 (2015)::Action|Crime|Thriller" . PHP_EOL;
        $line .= "4630562::The Fate of the Furious (2017)::Action|Crime|Thriller";

        $entity1 = (new MovieTweetingsEntity)
                ->setMovieId(2820852)
                ->setMovieTitle("Furious 7")
                ->setMovieYear(2015)
                ->setGenres([
                    "Action",
                    "Crime",
                    "Thriller",
                ]);

        $entity2 = (new MovieTweetingsEntity)
                ->setMovieId(4630562)
                ->setMovieTitle("The Fate of the Furious")
                ->setMovieYear(2017)
                ->setGenres([
                    "Action",
                    "Crime",
                    "Thriller",
                ]);

        $expected = [
            $entity1,
            $entity2,
        ];

        $adapter = new MovieTweetingsAdapter(new MovieTweetingsEntity);

        $this->assertEquals($expected, $adapter($line));
        $this->assertContainsOnlyInstancesOf(MovieTweetingsEntity::class, $expected);
    }

}

