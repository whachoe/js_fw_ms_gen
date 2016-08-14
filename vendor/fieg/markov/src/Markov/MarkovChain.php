<?php

namespace Fieg\Markov;

class MarkovChain
{
    /**
     * Historical data used to train the network in the following format:
     *
     * <code>
     *   array[<beginState>][<endState>] = <number of occurrences>
     * </code>
     *
     * @var array<mixed,array<mixed,int>>
     */
    protected $data = [];

    /**
     * Matrix with probabilities
     *
     * @see http://en.wikipedia.org/wiki/Transition_matrix
     *
     * @var array<mixed,array<mixed,float>>
     */
    protected $transitionMatrix = [];

    /**
     * Builds the historical data and (re)calculates the probabilities (transition matrix)
     *
     * @param mixed[] $chain list of states in temporal order
     */
    public function train(array $chain)
    {
        for ($i = 1, $l = count($chain); $i < $l; $i++) {
            $previous = $chain[$i - 1];
            $current = $chain[$i];

            @$this->data[$previous][$current]++;
        }

        $this->calculate();
    }

    /**
     * Returns the calculated transition matrix with probabilities
     *
     * @return array<mixed,array<mixed,float>>
     */
    public function getTransitionMatrix()
    {
        return $this->transitionMatrix;
    }

    /**
     * Queries the network
     *
     * @param mixed $state
     *
     * @return array<state,float> list of states ordered descending by highest probability
     */
    public function query($state)
    {
        $result = [];

        if (isset($this->transitionMatrix[$state])) {
            foreach ($this->transitionMatrix[$state] as $endState => $probability) {
                $result[$endState] = $probability;
            }

            asort($result);
        }

        return $result;
    }

    /**
     * Calculates probabilities and returns a transition matrix
     *
     * @return array<mixed,array<mixed,float>>
     */
    protected function calculate()
    {
        foreach ($this->data as $beginState => $endStates) {
            $total = array_sum($endStates);

            foreach ($endStates as $endState => $count) {
                $probability = $count / $total;
                $this->transitionMatrix[$beginState][$endState] = $probability;
            }
        }

        return $this->transitionMatrix;
    }
}
