import { IonicModule } from '@ionic/angular';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { MediaPage } from './media.page';
import { ExploreContainerComponentModule } from '../explore-container/explore-container.module';

import { MediaPageRoutingModule } from './media-routing.module';
import { IonRatingStarsModule } from 'ion-rating-stars';

@NgModule({
  imports: [
    IonicModule,
    CommonModule,
    FormsModule,
    ExploreContainerComponentModule,
    MediaPageRoutingModule,
    IonRatingStarsModule,
  ],
  declarations: [MediaPage]
})
export class MediaPageModule {}
