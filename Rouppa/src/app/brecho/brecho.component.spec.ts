import { ComponentFixture, TestBed } from '@angular/core/testing';

import { BrechoComponent } from './brecho.component';

describe('BrechoComponent', () => {
  let component: BrechoComponent;
  let fixture: ComponentFixture<BrechoComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [BrechoComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(BrechoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
