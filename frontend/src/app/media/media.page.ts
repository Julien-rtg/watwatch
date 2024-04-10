import { Component, effect } from '@angular/core';
import { QuestionnaireService } from '../services/questionnaire.service';

@Component({
  selector: 'app-media',
  templateUrl: 'media.page.html',
  styleUrls: ['media.page.scss'],
})
export class MediaPage {
  medias: any = [];
  
  public constructor(public questionnaireService: QuestionnaireService) {
    effect(() => {
      this.medias = questionnaireService.emitMedia();
      console.log(this.medias);
    });
  }



}
