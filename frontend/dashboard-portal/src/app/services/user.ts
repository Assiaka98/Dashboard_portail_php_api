import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class UserService {
  private apiUrl = 'https://dashboard-portail-php-api-50932ed4.platform-systalink.com/api/users';

  constructor(private http: HttpClient) {}

  // Récupérer la liste des utilisateurs[cite: 11]
  getUsers(): Observable<any> {
    return this.http.get<any>(this.apiUrl);
  }

  // Archiver un utilisateur (requête PUT vers /api/users/{id}/archive)[cite: 11]
  archiveUser(id: number): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/${id}/archive`, {});
  }

  // Désarchiver un utilisateur (requête PUT vers /api/users/{id}/unarchive)
  unarchiveUser(id: number): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/${id}/unarchive`, {});
  }

  // Mettre à jour le rôle d'un utilisateur[cite: 11]
  updateUserRole(id: number, roleEtat: number): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/${id}/role`, { role_etat: roleEtat });
  }
}
