import { catchError, Observable, Subject, throwError } from 'rxjs';
import { Injectable } from '@angular/core';
import {
  HttpClient,
  HttpErrorResponse,
  HttpHeaders,
} from '@angular/common/http';
import { Config } from 'src/app/config/config';

@Injectable()
export class ApiMediaService {
  apiUrl: string = '';

  public httpOptions;

  public constructor(private http: HttpClient, private config: Config) {
    this.apiUrl = config.getApiUrl();
    this.httpOptions = {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
      }),
    };
  }

  private handleError(err: HttpErrorResponse): Observable<never> {
    return throwError(() => err);
  }
}
