import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class UserService {
  // Utilisation d'un chemin relatif pour éviter tout problème de domaine ou de CORS
  private apiUrl = '/api/users';

  constructor(private http: HttpClient) {}

  getUsers(): Observable<any> {
    return this.http.get<any>(this.apiUrl);
  }

  archiveUser(id: number): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/${id}/archive`, {});
  }

  unarchiveUser(id: number): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/${id}/unarchive`, {});
  }

  updateUserRole(id: number, roleEtat: number): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/${id}/role`, { role_etat: roleEtat });
  }
}
