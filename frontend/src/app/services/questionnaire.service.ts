import { Injectable, signal } from '@angular/core';

@Injectable()
export class QuestionnaireService {

  emitQuestionnaireNav = signal(0);
  emitMedia = signal([]);

  setQuestionnaireNav(value:number){
    this.emitQuestionnaireNav.set(value);
  }

  setMedia(value:any){
    this.emitMedia.set(value);
  }

}
