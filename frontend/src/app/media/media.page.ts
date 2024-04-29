import { Component, effect } from '@angular/core';
import { QuestionnaireService } from '../services/questionnaire.service';

@Component({
  selector: 'app-media',
  templateUrl: 'media.page.html',
  styleUrls: ['media.page.scss'],
})
export class MediaPage {
  medias: any = [];
  noMediasFound: boolean = false;
  
  public constructor(public questionnaireService: QuestionnaireService) {
    effect(() => {
      if(questionnaireService.emitMedia() === 'init') {
        return;
      }
      this.medias = questionnaireService.emitMedia();
      this.medias.forEach((media: any) => {
        media.provider_vote_average = Math.round(media.provider_vote_average / 2);
        media.seeMore = false;
      });
      if(this.medias.length === 0) {
        this.noMediasFound = true;
      }
      console.log(this.medias);
    });
    effect(() => {
      if(questionnaireService.resetMedias()){
        this.noMediasFound = false;
        this.medias = [];
      }
    });

  }

  toggleDescription(index: number) {
    this.medias[index].seeMore = !this.medias[index].seeMore;
  }

}
