import { Component, OnInit, ChangeDetectorRef } from '@angular/core';
import { CommonModule } from '@angular/common';
import { UserService } from './services/user';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './app.html',
  styleUrls: ['./app.css']
})
export class App implements OnInit {
  users: any[] = [];
  errorMessage: string = '';
  isModalOpen: boolean = false;
  selectedUserId: number | null = null;
  modalAction: 'archive' | 'unarchive' = 'archive';

  constructor(
    private userService: UserService,
    private cdr: ChangeDetectorRef
  ) {}

  ngOnInit(): void {
    this.loadUsers();
  }

  loadUsers(): void {
    this.userService.getUsers().subscribe({
      next: (response: any) => {
        this.users = Array.isArray(response) ? response : (response.data || []);
        console.log('Tableau final this.users :', this.users);
        this.cdr.detectChanges();
      },
      error: (error: any) => {
        console.error('Erreur lors du chargement des utilisateurs', error);
        this.errorMessage = 'Impossible de charger les utilisateurs depuis le serveur PHP.';
        this.cdr.detectChanges();
      }
    });
  }

  toggleRole(user: any): void {
    user.role_etat = user.role_etat == 2 ? 1 : 2;
    this.cdr.detectChanges();
  }

  openModal(userId: number, action: 'archive' | 'unarchive'): void {
    this.selectedUserId = userId;
    this.modalAction = action;
    this.isModalOpen = true;
    this.cdr.detectChanges();
  }

  closeModal(): void {
    this.isModalOpen = false;
    this.selectedUserId = null;
    this.cdr.detectChanges();
  }

  confirmAction(): void {
    if (this.selectedUserId === null) return;

    if (this.modalAction === 'archive') {
      console.log('Archivage de l’utilisateur ID :', this.selectedUserId);
      // TODO: Appel API pour archiver
    } else {
      console.log('Désarchivage de l’utilisateur ID :', this.selectedUserId);
      // TODO: Appel API pour désarchiver
    }

    this.closeModal();
    this.loadUsers();
  }
}
