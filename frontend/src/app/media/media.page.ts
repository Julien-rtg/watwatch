import { Component, effect } from '@angular/core';
import { QuestionnaireService } from '../services/questionnaire.service';
import { ApiMediaService } from '../services/api/api-media.service';

@Component({
  selector: 'app-media',
  templateUrl: 'media.page.html',
  styleUrls: ['media.page.scss'],
})
export class MediaPage {
  medias: any = [];
  noMediasFound: boolean = false;
  infiniteScroll: any;
  
  public constructor(public questionnaireService: QuestionnaireService, public apiMediaService: ApiMediaService) {
    effect(() => {
      if(questionnaireService.emitMedia() === 'init') {
        return;
      }

      this.medias = this.medias.concat(questionnaireService.emitMedia().data);
      if(this.infiniteScroll) {
        this.infiniteScroll.target.complete();
      }
      console.log(questionnaireService.emitMedia());
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

  loadMoreMedia(infiniteScroll: any) {
    this.infiniteScroll = infiniteScroll;
    this.apiMediaService.getMediaByGenresAndProviders(this.questionnaireService.emitGenres(), this.questionnaireService.emitProviders(), this.questionnaireService.emitMedia().next_page_url);
  }

}
