import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  standalone: false,
  styleUrl: './app.component.css'
})
export class AppComponent {
  nombre = 'Celia';
  apellido = "Marín";
  edad : number = 16;
  fumadora = false;
  sueldo : number[] = [1000, 2000, 3000];
  contador : number = 0;

  provincias =[
    {id:1, nombre:"Huelva"},
    {id:2, nombre:"Sevilla"},
    {id:3, nombre:"Almería"},
    {id:4, nombre:"Cádiz"},
  ];

  esFumador(){
    return this.fumadora?"Es fumadora":"No es fumadora";
  }

  diHola(){
    alert("HOLA");
  }

  incrementar(){
    this.contador++;
  }

  decrementar(){
    this.contador--;
  }



}
