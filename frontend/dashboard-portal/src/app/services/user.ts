import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class UserService {
  private apiUrl = 'https://dashboard-portail-php-api-50932ed4.platform-systalink.com/api/users';

  constructor(private http: HttpClient) {}

  getUsers(): Observable<any> {
    return this.http.get<any>(this.apiUrl);
  }

  archiveUser(id: number): Observable<any> {
    return this.http.delete<any>(`${this.apiUrl}/${id}`);
  }

  updateUserRole(id: number, roleEtat: number): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/${id}/role`, { role_etat: roleEtat });
  }
}
