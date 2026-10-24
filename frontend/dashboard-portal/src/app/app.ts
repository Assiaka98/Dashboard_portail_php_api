import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { UserService } from './services/user';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './app.html',
  styleUrl: './app.css'
})
export class App implements OnInit {
  users: any[] = [];
  errorMessage: string = '';

  // État de la popup de confirmation
  isModalOpen: boolean = false;
  userToArchiveId: number | null = null;

  constructor(private userService: UserService) {}

  ngOnInit(): void {
    this.loadUsers();
  }

loadUsers(): void {
    this.userService.getUsers().subscribe({
      next: (response: any) => {
        console.log('Réponse brute de l’API :', response);
        this.users = Array.isArray(response) ? response : (response.data || []);
        console.log('Tableau final this.users :', this.users);
      },
      error: (error: any) => {
        console.error('Erreur lors du chargement des utilisateurs', error);
        this.errorMessage = 'Impossible de charger les utilisateurs depuis le serveur PHP.';
      }
    });
  }

  // Ouvrir la popup moderne au lieu de confirm()
  openArchiveModal(id: number): void {
    this.userToArchiveId = id;
    this.isModalOpen = true;
  }

  // Fermer la popup
  closeModal(): void {
    this.isModalOpen = false;
    this.userToArchiveId = null;
  }

  // Confirmer l'archivage depuis la popup
  confirmArchive(): void {
    if (this.userToArchiveId !== null) {
      this.userService.archiveUser(this.userToArchiveId).subscribe({
        next: () => {
          this.closeModal();
          this.loadUsers();
        },
        error: (error: any) => {
          console.error("Erreur lors de l'archivage", error);
        }
      });
    }
  }

  // Basculer le rôle (Admin / User)
toggleRole(user: any): void {
    // Convertit en nombre pour éviter les conflits entre string et number
    const currentRole = Number(user.role_etat);
    const newRoleEtat = currentRole === 2 ? 1 : 2;

    this.userService.updateUserRole(user.id, newRoleEtat).subscribe({
      next: () => {
        this.loadUsers(); // Recharge la liste pour refléter le nouveau rôle
      },
      error: (error: any) => {
        console.error("Erreur lors de la mise à jour du rôle", error);
      }
    });
  }
}
