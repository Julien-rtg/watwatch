import { catchError, Observable, Subject, throwError } from 'rxjs';
import { Injectable } from '@angular/core';
import {
  HttpClient,
  HttpErrorResponse,
  HttpHeaders,
} from '@angular/common/http';
import { Config } from 'src/app/config/config';

@Injectable()
export class ApiProviderService {
  apiUrl: string = '';

  public httpOptions;

  public constructor(public http: HttpClient, public config: Config) {
    this.apiUrl = config.getApiUrl();
    this.httpOptions = {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
      }),
    };
  }

  getProviders(): Observable<any> {
    let data = new Subject();
    this.http
      ?.get(`${this.apiUrl}provider`)
      .pipe(catchError(this.handleError))
      .subscribe({
        next: (providers: any) => {
          data.next(providers);
        },
      });

    return data.asObservable();
  }

  private handleError(err: HttpErrorResponse): Observable<never> {
    return throwError(() => err);
  }
}
