<?php

namespace Fieg\Markov;

class MarkovChainTest extends \PHPUnit_Framework_TestCase
{
    public function testTrainUpdatesTransitionMatrix()
    {
        $sentences = [
            'my blue car',
            'red and blue flowers',
            'his blue car',
        ];

        $chain = new MarkovChain();

        foreach ($sentences as $sentence) {
            $tokens = explode(" ", $sentence);

            $chain->train($tokens);
        }

        $this->assertEquals(
            [
                'my' => [
                    'blue' => 1,
                ],
                'blue' => [
                    'car' => 0.66666666666667,
                    'flowers' => 0.33333333333333,
                ],
                'red' => [
                    'and' => 1,
                ],
                'and' => [
                    'blue' => 1,
                ],
                'his' => [
                    'blue' => 1,
                ],
            ],
            $chain->getTransitionMatrix()
        );
    }

    public function testQuery()
    {
        $sentences = [
            'my blue car',
            'red and blue flowers',
            'his blue car',
        ];

        $chain = new MarkovChain();

        foreach ($sentences as $sentence) {
            $tokens = explode(" ", $sentence);

            $chain->train($tokens);
        }

        $this->assertEquals(
            [
                'car' => 0.66666666666667,
                'flowers' => 0.33333333333333,
            ],
            $chain->query("blue")
        );
    }
}
