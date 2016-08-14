/**
 * Created by cjpa on 14/08/16.
 */
(function ($) {
    "use strict"; // Start of use strict




    function pickRandom(from) {
        return from[Math.floor(Math.random() * from.length)];
    }


    var Foswig = require('foswig');
    var chain = new Foswig.MarkovChain(3);

    //load the words into the markov chain
    chain.addWordsToChain(names);

    // $("#jsname").text(chain.generateWord());
    // $("#homeHeading").text(pickRandom(titles));


})(jQuery); // End of use strict