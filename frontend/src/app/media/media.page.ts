import { Component, effect } from '@angular/core';
import { QuestionnaireService } from '../services/questionnaire.service';

@Component({
  selector: 'app-media',
  templateUrl: 'media.page.html',
  styleUrls: ['media.page.scss'],
})
export class MediaPage {
  media: any = [];
  
  public constructor(public questionnaireService: QuestionnaireService) {
    effect(() => {
      this.media = questionnaireService.emitMedia();
      console.log(this.media);
    });
  }



}
