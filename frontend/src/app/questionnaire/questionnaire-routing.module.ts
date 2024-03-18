import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { QuestionnairePage } from './questionnaire.page';

const routes: Routes = [
  {
    path: '',
    component: QuestionnairePage,
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class QuestionnairePageRoutingModule {}
