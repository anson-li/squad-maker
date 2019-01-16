# Squad Maker Challenge

The challenge is to build an application that creates equally matched hockey squads from a collection of players. 

Craft a solution that: 
* you would consider to be representative of your level of professionalism
* you would be comfortable handing off to someone else to maintain
* uses a technology that you are comfortable with
* notes any assumptions that you make

## Problem Description

Your company is organizing a recreational shinny (hockey) tournament. A number of players have registered online for the tournament and each player has been assigned a rating for three different skills:

* Skating
* Shooting
* Checking

The organizer has tasked you with creating the squads for the tournament. You are free to do this however you like, but you have been asked to keep the following points in mind:

* The organizer doesn't know how many squads there will be yet
* Each squad must have the same number of players
  * Any players that cannot be assigned to a squad will be placed on a waiting list (ex. if there are 40 players and the organizer wants 6 squads, there will be 4 players on the waiting list)
* Each squad must closely balance in each of the three skills

### Player Data

The player data will be made availabe via a REST API from the registration team. Unfortunately, their API is not yet availabe. For now, the registration team has offered you sample player data in the [players.json](./players.json) file. The format of the data in the file will match the format of the REST response when it is available, at which point you will need to be able to quickly integrate it.

To generate additional random data for the JSON reponse, use the content from the file [playerGenerator.txt](./playerGenerator.txt) and run in through the JSON generator at the following website https://www.json-generator.com

You can change the value in `repeat(40)` to generate data for any number of players.

### UI Features

You have decided to build a small web application for this task. The organizer likes this approach and you discuss the following features:

* By default, the home page will show all players as being on the waiting list
* There will be a control that allows the user to enter the number of desired squads
* There will be a button that, when clicked, will generate the desired number of squads and put the remainder in the waiting list
* There will be a button that, when clicked, will reset the application and put all of the players back on the waiting list
* The generated squads will display the following:
  * Details For Each Player
    * Full Player Name
    * Skating Rating
    * Shooting Rating
    * Checking Rating
  * Squad Shooting Average
  * Squad Skating Average
  * Squad Checking Average
* The waiting list will display the following:

  * Details For Each Player
    * Full Player Name
    * Skating Rating
    * Shooting Rating
    * Checking Rating

The organizer has left the look and feel of the application and the technologies to use in your capable hands.

## Example Output

The API returns the following player data, which is then displayed on the home page.

_This is example output to help you understand the problem only. Make yours look pretty!_

**Waiting List**

| Player      | Skating | Shooting | Checking |
| ----------- | :-----: | :------: | :------: |
| Alex Carney |   90    |    98    |    92    |
| Bob Smith   |   80    |    60    |    50    |
| Roy Talbot  |   60    |    85    |    20    |
| Jill White  |   70    |    90    |    60    |
| Jennifer Wu |   94    |    55    |   100    |

The user selects 2 squads and clicks the button to generate the squads. The following squads and a waiting list is formed from your algorithm: 

**Waiting List**

| Player      | Skating | Shooting | Checking |
| ----------- | :-----: | :------: | :------: |
| Alex Carney |   90    |    98    |    92    |

**Squad 1**

| Player      | Skating | Shooting | Checking |
| ----------- | :-----: | :------: | :------: |
| Bob Smith   |   80    |    60    |    50    |
| Jill White  |   70    |    90    |    60    |
| **Average** |   75    |    75    |    55    |

**Squad 2**

| Player      | Skating | Shooting | Checking |
| ----------- | :-----: | :------: | :------: |
| Roy Talbot  |   60    |    85    |    20    |
| Jennifer Wu |   94    |    55    |   100    |
| **Average** |   77    |    70    |    60    |