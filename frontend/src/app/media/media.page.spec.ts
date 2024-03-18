import { ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { ExploreContainerComponentModule } from '../explore-container/explore-container.module';

import { MediaPage } from './media.page';

describe('MediaPage', () => {
  let component: MediaPage;
  let fixture: ComponentFixture<MediaPage>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [MediaPage],
      imports: [IonicModule.forRoot(), ExploreContainerComponentModule]
    }).compileComponents();

    fixture = TestBed.createComponent(MediaPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
