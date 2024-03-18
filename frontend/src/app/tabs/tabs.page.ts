import { Component } from '@angular/core';
import { QuestionnaireService } from '../services/questionnaire.service';

@Component({
  selector: 'app-tabs',
  templateUrl: 'tabs.page.html',
  styleUrls: ['tabs.page.scss'],
})
export class TabsPage {
  constructor(public questionnaireService: QuestionnaireService) {}

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
}
