# Squad-Maker

Squad maker is an application that creates equally matched hockey squads from a collection of players. It was developed in pure PHP/HTML/CSS, and uses Bootstrap/jQuery. 

# Live Demo

Squadmaker is currently hosted on [http://squadmaker.ansonli.ca](http://squadmaker.ansonli.ca). Check it out!

# Problem

To see the problem material, please review the PROBLEM.md file.

# Assumptions

To see the assumption list, please review the NOTES.md file.

# Design

Squad Maker is designed to find an adequate solution to the problem: given N users with three different attributes, fit them into bins M so that all three different attributes are as balanced as possible, and all bins contain equal number of users.

Squad Maker is designed with the following input limitations:

- The input number of squads must be greater than 1 (squads will be pitted against each other so no need for 1 supergroup) and less than or equal to the number of players.

Additionally, Squad Maker employs the following algorithm to setup squads:

  1. Given a number of squads, calculate the number of players that have to be attached to each squad, as well as the maximum/average value for each of the three skills (skating, shooting, checking) across the entire player list.
  2. Sort the pool of players from least to most, calculating the average of all three components.
    a. We're calculating from least to most in order to put players of 'less impact' into teams first. If players with the most impact enter first, it could result in more uneven teams.
  3. For each squad (in order), take the pool of players and insert them into each squad, attempting to minimize the amount of impact applied to each one and accounting for best fit. 
    a. Take into account 'user balancing' in order to make a balanced team. For example, if a squad already has several members that are good at skating, pick players that are worse at skating until the team is balanced.
    b. Continue to increase 'variance' count, until a potential match is made. Limit cannot be set to a maximum as we can't return false unless an error has occured.

[Initial Design of Squad Maker]
![Initial Design of Squad Maker](https://github.com/anson-li/squad-maker/blob/master/additional/design.png)
