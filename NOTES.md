# Notes for Code

## General Assumptions

* Player quantity beats the quality of each individual player. So, if there are only three users and they need to be split into three teams, they'll be split first - even if there are large skill differences.
* Squads attempt to include as many members as possible - eg. if there are 40 players and 3 squads, each squad should contain 13 players (with 1 left on the waiting list).
* If there are less players than squads, then either return an error or fit as many players as you can for each squad (eg. 3 squads, 2 people = 1 person per squad, twice).

## Design Process

* Almost the same as a packing problem (giving N objects of various sizes and M boxes of equal sizes, find the minimal number of boxes required to fit all objects) - except there's a few variations:

  1. Objects have multiple parameters - in this case, 3
  2. Box count is fixed, but constraint is flexible (no volume/weight limit other than squad count and aforementioned parameters)
  3. We're finding the averages of the parameters, not the maximum limit of the parameters - so greedy algorithm isn't as optimal here

* Classic partition problem, with slight changes

  1. Can never return false; instead, find the best outcome for the situation
  2. Number of squads is not fixed, so no way to sort components
  3. Multiple parameters so standard greedy algorithm doesn't fit naturally

* Finding the average of any value is simply finding the maximum of any value and dividing it by count. So we can calculate up to maximum (like most partition/packing problems).
* We have a 'variance' we need to identify. Whether or not the subsets are within an acceptable range is also important! 
  * Options: continue to iterate, increasing the variance measurement each time.

## Algorithm Implementation

* Across the entire subset, we want to make sure that all squads contain the same amount of players. Then, ensure that differences in the averages for every single one is minimal. 

A possible implementation would be as follows:

    A. If the count of players is less than the count of squads, place a player in each available squad and return.

    1. Given the number of squads, calculate the number of players that have to be attached to each squad, as well as the maximum/average value for each of the three skills (skating, shooting, checking).
    2. Sort the pool of players from least to most, calculating the average of all three components.
    3. For each, take the pool of players and insert them into each squad, attempting to minimize the amount of impact applied to each one. 
      a. Continue to increase 'variance' count, until a potential match is made.  
        - Limit cannot be set to a maximum as we can't return false unless an error has occured.

## References

* https://www8.cs.umu.se/kurser/TDBA77/VT06/algorithms/BOOK/BOOK2/NODE45.HTM
* https://arxiv.org/pdf/cond-mat/0310317.pdf