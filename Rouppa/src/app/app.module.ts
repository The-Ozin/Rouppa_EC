import { NgModule } from '@angular/core';
import { BrowserModule, provideClientHydration } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { MainIndexComponent } from './main-index/main-index.component';
import { LojaComponent } from './loja/loja.component';
import { BrechoComponent } from './brecho/brecho.component';

@NgModule({
  declarations: [
    AppComponent,
    MainIndexComponent,
    LojaComponent,
    BrechoComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule
  ],
  providers: [
    provideClientHydration()
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
