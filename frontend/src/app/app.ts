import {Component, inject, Injectable} from '@angular/core';
import { RouterOutlet } from '@angular/router';
import {HttpClient} from "@angular/common/http";
@Injectable({providedIn: 'root'})
@Component({
  selector: 'app-root',
  imports: [RouterOutlet],
  templateUrl: './app.html',
  styleUrl: './app.css'
})

export class App {
  private http = inject(HttpClient);
  protected title = 'angular-temp';

  constructor() {
    this.http.get('http://localhost/api/list/company').subscribe(company => {
      console.log(company)
    })
  }
}
