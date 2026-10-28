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
        console.log('Liste des utilisateurs chargée :', this.users);
        this.cdr.detectChanges();
      },
      error: (error: any) => {
        console.error('Erreur lors du chargement des utilisateurs', error);
        this.errorMessage = 'Impossible de charger les utilisateurs depuis le serveur PHP.';
        this.cdr.detectChanges();
      }
    });
  }

  // Vérifier si un utilisateur est archivé (basé sur etat == 1 ou date_archive non nulle)
  isArchived(user: any): boolean {
    return user.etat == 1 || user.date_archive !== null;
  }

  // Gérer le changement de rôle
  toggleRole(user: any): void {
    if (this.isArchived(user)) return; // Empêcher si l'utilisateur est archivé

    const newRoleEtat = user.role_etat == 1 ? 0 : 1;

    this.userService.updateUserRole(user.id, newRoleEtat).subscribe({
      next: () => {
        user.role_etat = newRoleEtat;
        this.cdr.detectChanges();
      },
      error: (err) => console.error('Erreur lors de la mise à jour du rôle', err)
    });
  }

  // Ouvrir la modale pour archiver ou désarchiver
  openModal(userId: number, action: 'archive' | 'unarchive'): void {
    this.selectedUserId = userId;
    this.modalAction = action;
    this.isModalOpen = true;
    this.cdr.detectChanges();
  }

  // Fermer la modale
  closeModal(): void {
    this.isModalOpen = false;
    this.selectedUserId = null;
    this.cdr.detectChanges();
  }

  // Confirmer l'action d'archivage ou de désarchivage depuis la modale
  confirmAction(): void {
    if (this.selectedUserId === null) return;

    if (this.modalAction === 'archive') {
      console.log('Exécution de l’archivage pour l’ID :', this.selectedUserId);
      this.userService.archiveUser(this.selectedUserId).subscribe({
        next: () => {
          this.loadUsers(); // Recharge la liste pour refléter le changement
          this.closeModal();
        },
        error: (err) => {
          console.error('Erreur lors de l’archivage', err);
          this.closeModal();
        }
      });
    } else {
      console.log('Exécution du désarchivage pour l’ID :', this.selectedUserId);
      this.userService.unarchiveUser(this.selectedUserId).subscribe({
        next: () => {
          this.loadUsers(); // Recharge la liste pour refléter le changement
          this.closeModal();
        },
        error: (err) => {
          console.error('Erreur lors du désarchivage', err);
          this.closeModal();
        }
      });
    }
  }
}
