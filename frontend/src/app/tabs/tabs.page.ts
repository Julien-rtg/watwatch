import { Component, effect } from '@angular/core';
import { QuestionnaireService } from '../services/questionnaire.service';
import { NavigationEnd, Router } from '@angular/router';

@Component({
  selector: 'app-tabs',
  templateUrl: 'tabs.page.html',
  styleUrls: ['tabs.page.scss'],
})
export class TabsPage {
  navigationIndex: number = 0;
  currentRoute: string = '';

  constructor(public questionnaireService: QuestionnaireService, private router: Router) {
    effect(() => {
      this.navigationIndex = this.questionnaireService.emitQuestionnaireNav();
    });
    this.router.events.subscribe((event) => {
      if (event instanceof NavigationEnd) {
        this.currentRoute = event.url;
      }
    });
  }

  triggerNav(value: string) {
    if (value === 'back') {
      this.questionnaireService.setQuestionnaireNav(
        this.questionnaireService.emitQuestionnaireNav() - 1
      );
    } else if (value === 'next') {
      this.questionnaireService.setQuestionnaireNav(
        this.questionnaireService.emitQuestionnaireNav() + 1
      );
    }
  }

  resetNav() {
    this.questionnaireService.setQuestionnaireNav(0);
  }
  
}
