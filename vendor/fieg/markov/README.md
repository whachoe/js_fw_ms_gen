Markov Chain
============

Implementation of MarkovChain algorithm in PHP.

[![Build Status](https://travis-ci.org/fieg/markov.png?branch=master)](https://travis-ci.org/fieg/markov)

Getting started
---------------

```php
use Fieg\Markov\MarkovChain;

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

$result = $chain->query("blue");
```

Which would result in:

```
array(2) {
  'car' =>
  double(0.66666666666667)
  'flowers' =>
  double(0.33333333333333)
}
```
