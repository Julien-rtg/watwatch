import { catchError, Observable, Subject, throwError } from 'rxjs';
import { Injectable } from '@angular/core';
import {
  HttpClient,
  HttpErrorResponse,
  HttpHeaders,
} from '@angular/common/http';
import { Config } from 'src/app/config/config';

@Injectable()
export class ApiGenreService {
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

  getGenre(): Observable<any> {
    let data = new Subject();
    this.http
      ?.get(`${this.apiUrl}genre`)
      .pipe(catchError(this.handleError))
      .subscribe({
        next: (genres: any) => {
          data.next(genres);
        },
      });

    return data.asObservable();
  }

  private handleError(err: HttpErrorResponse): Observable<never> {
    return throwError(() => err);
  }
}
