import { Injectable, signal } from '@angular/core';

@Injectable()
export class QuestionnaireService {

  emitQuestionnaireNav = signal(0);

  setQuestionnaireNav(value:number){
    this.emitQuestionnaireNav.set(value);
  }

}
