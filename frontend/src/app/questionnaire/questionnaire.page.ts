import { Component, computed, effect } from '@angular/core';
import { ApiProviderService } from '../services/api/api-provider.service';
import { QuestionnaireService } from '../services/questionnaire.service';
import { ApiGenreService } from '../services/api/api-genre.service';
import { Router } from '@angular/router';
import { ApiMediaService } from '../services/api/api-media.service';

@Component({
  selector: 'app-tab1',
  templateUrl: 'questionnaire.page.html',
  styleUrls: ['questionnaire.page.scss'],
})
export class QuestionnairePage {
  providers: any = [];
  genres: any = [];
  navigationState: string[] = ['plateform', 'genre'];
  navigationStateIndex: number = 0;
  selectedPlatforms: any = [];
  selectedGenres: any = [];

  constructor(
    providerService: ApiProviderService,
    genreService: ApiGenreService,
    public apiMediaService: ApiMediaService,
    public questionnaireService: QuestionnaireService,
    route: Router
  ) {
    providerService.getProviders().subscribe({
      next: (result: any) => {
        this.providers = result;
      },
      error: (err: any) => {},
    });
    genreService.getGenre().subscribe({
      next: (result: any) => {
        this.genres = result;
        console.log(this.genres);
      },
      error: (err: any) => {},
    });

    effect(() => {
      this.navigationStateIndex = questionnaireService.emitQuestionnaireNav();
      if (this.navigationStateIndex === 2) {
        route.navigateByUrl('tabs/media');
        this.getMediaByGenresAndProviders();
      }
    });
    effect(() => {
      if (questionnaireService.resetQuestionnaire()) {
        this.selectedGenres = [];
        this.selectedPlatforms = [];
      }
    });
  }

  getMediaByGenresAndProviders() {
    console.log('selectedGenres', this.selectedGenres);
    console.log('selectedPlatforms', this.selectedPlatforms);
    this.apiMediaService.getMediaByGenresAndProviders(
      this.selectedGenres,
      this.selectedPlatforms
    );
  }

  appendPlatform(provider: any) {
    const index = this.selectedPlatforms.findIndex(
      (val: any) => val === provider.id
    );
    if (index === -1) {
      this.selectedPlatforms.push(provider.id);
    } else {
      this.selectedPlatforms.splice(index, 1);
    }
    this.questionnaireService.emitProviders.set(this.selectedPlatforms);
    console.log(this.selectedPlatforms);
  }

  appendGenre(genre: any) {
    const index = this.selectedGenres.findIndex(
      (val: any) => val === genre.id
    );
    if (index === -1) {
      this.selectedGenres.push(genre.id);
    } else {
      this.selectedGenres.splice(index, 1);
    }
    this.questionnaireService.emitGenres.set(this.selectedGenres);
    console.log(this.selectedGenres);
  }

  handleChange(ev: any) {
    console.log('Current value:', JSON.stringify(ev.target.value));
  }
}
