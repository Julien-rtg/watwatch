import { Injectable, signal } from '@angular/core';

@Injectable()
export class QuestionnaireService {

  emitQuestionnaireNav = signal(0);
  emitMedia = signal<any>('init');
  resetQuestionnaire = signal(0);
  resetMedias = signal(0);
  emitGenres = signal<any>([]);
  emitProviders = signal<any>([]);

  setQuestionnaireNav(value:number){
    this.emitQuestionnaireNav.set(value);
    if(value === 2) {
      this.resetMedia();
    }
  }

  setMedia(value:any){
    this.emitMedia.set(value);
  }

  resetQuestion() {
    this.resetQuestionnaire.set((this.resetQuestionnaire())+1);
  }

  resetMedia() {
    this.resetMedias.set((this.resetMedias())+1);
  }

}
