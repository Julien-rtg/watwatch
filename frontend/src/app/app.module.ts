import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouteReuseStrategy } from '@angular/router';

import { IonicModule, IonicRouteStrategy } from '@ionic/angular';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { ApiMediaService } from './services/api/api-media.service';
import { ApiProviderService } from './services/api/api-provider.service';
import { Config } from './config/config';
import { HttpClientModule } from '@angular/common/http';
import { QuestionnaireService } from './services/questionnaire.service';
import { ApiGenreService } from './services/api/api-genre.service';

@NgModule({
  declarations: [AppComponent],
  imports: [
    BrowserModule,
    IonicModule.forRoot(),
    AppRoutingModule,
    HttpClientModule,
  ],
  providers: [
    { provide: RouteReuseStrategy, useClass: IonicRouteStrategy },
    Config,
    ApiMediaService,
    ApiProviderService,
    ApiGenreService,
    QuestionnaireService,
  ],
  bootstrap: [AppComponent],
})
export class AppModule {}
