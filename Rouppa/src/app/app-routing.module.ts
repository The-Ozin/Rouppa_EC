import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { MainIndexComponent } from './main-index/main-index.component';
import { LojaComponent } from './loja/loja.component';
import { BrechoComponent } from './brecho/brecho.component';

const routes: Routes = [
  { path: 'main', component: MainIndexComponent},
  { path: 'loja', component: LojaComponent },
  { path: 'brecho', component: BrechoComponent },
  { path: '', redirectTo: '/main', pathMatch: 'full' },
  { path: '**', redirectTo: '/main' } 
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
