import { Injectable, signal } from '@angular/core';

@Injectable()
export class QuestionnaireService {

  emitQuestionnaireNav = signal(0);
  emitQuestionnaireQueryMedia = signal(null);

  setQuestionnaireNav(value:number){
    this.emitQuestionnaireNav.set(value);
  }

  setQuestionnaireMedia(data: any){
    this.emitQuestionnaireQueryMedia.set(data);
  }
}
