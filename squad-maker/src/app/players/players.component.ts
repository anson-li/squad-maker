import { Component, OnInit } from '@angular/core';
import * as data from '../players.json';

@Component({
  selector: 'app-players',
  templateUrl: './players.component.html',
  styleUrls: ['./players.component.css']
})
export class PlayersComponent implements OnInit {

  Players = data['players'];

  constructor() { 
  }

  ngOnInit() {
  }

}
