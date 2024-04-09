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

  getMediaByGenresAndProviders(
    genres: any,
    providers: any
  ): Observable<any> {
    let data = new Subject();
    this.http
      ?.post(`${this.apiUrl}media/getMediaByGenreAndProvider`, { genres, providers })
      .pipe(catchError(this.handleError))
      .subscribe({
        next: (media: any) => {
          data.next(media);
        },
      });

    return data.asObservable();
  }

  private handleError(err: HttpErrorResponse): Observable<never> {
    return throwError(() => err);
  }
}
