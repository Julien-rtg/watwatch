import { Injectable } from "@angular/core";

@Injectable()
export class Config{

  private apiUrl:string = 'http://localhost:8000/api/';

  public getApiUrl(){
    return this.apiUrl;
  }

}
