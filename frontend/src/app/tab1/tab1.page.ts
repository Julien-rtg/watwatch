import { Component } from '@angular/core';
import { ApiProviderService } from '../services/api-provider.service';

@Component({
  selector: 'app-tab1',
  templateUrl: 'tab1.page.html',
  styleUrls: ['tab1.page.scss'],
})
export class Tab1Page {
  providers: any = [];

  foods = [
    {
      id: 1,
      name: 'Apples',
      type: 'fruit',
    },
    {
      id: 2,
      name: 'Carrots',
      type: 'vegetable',
    },
    {
      id: 3,
      name: 'Cupcakes',
      type: 'dessert',
    },
  ];

  constructor(providerService: ApiProviderService) {
    providerService.getProviders().subscribe({
      next: (result:any) => {
        this.providers = result;
        console.log(this.providers);
      },
      error: (err:any) => {
        
      }
    });    
  }

  handleChange(ev: any) {
    console.log('Current value:', JSON.stringify(ev.target.value));
  }
}
