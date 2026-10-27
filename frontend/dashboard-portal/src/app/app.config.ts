import { ApplicationConfig } from '@angular/core';
import { provideRouter } from '@angular/router';
import { provideHttpClient } from '@angular/common/http'; // <-- Importez ceci
import { routes } from './app.routes';

export const appConfig: ApplicationConfig = {
  providers: [
    provideRouter(routes),
    provideHttpClient() // <-- Ajoutez ceci pour autoriser les requêtes API
  ]
};
// src/app/config.ts
export const API_URL = 'https://dashboard-portail-php-api-50932ed4.platform-systalink.com/api';
