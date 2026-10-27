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

  // Vérifier si un utilisateur est archivé
  isArchived(user: any): boolean {
    return user.etat === 'archive' || user.date_archive !== null;
  }

  toggleRole(user: any): void {
    if (this.isArchived(user)) return; // Empêcher si archivé
    user.role_etat = user.role_etat == 2 ? 1 : 2;
    
    // Appel API pour mettre à jour le rôle si nécessaire
    this.userService.updateUserRole(user.id, user.role_etat).subscribe({
      error: (err) => console.error('Erreur mise à jour rôle', err)
    });

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
      this.userService.archiveUser(this.selectedUserId).subscribe({
        next: () => {
          this.loadUsers();
        },
        error: (err) => console.error('Erreur lors de l’archivage', err)
      });
    } else {
      console.log('Désarchivage de l’utilisateur ID :', this.selectedUserId);
      this.userService.unarchiveUser(this.selectedUserId).subscribe({
        next: () => {
          this.loadUsers();
        },
        error: (err) => console.error('Erreur lors du désarchivage', err)
      });
    }

    this.closeModal();
  }
}