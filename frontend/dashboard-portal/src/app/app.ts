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
        this.cdr.detectChanges();
      },
      error: (error: any) => {
        console.error('Erreur lors du chargement', error);
        this.errorMessage = 'Impossible de charger les utilisateurs depuis le serveur PHP.';
        this.cdr.detectChanges();
      }
    });
  }

  isArchived(user: any): boolean {
    return user.etat == 1 || user.date_archive !== null;
  }

  toggleRole(user: any): void {
    if (this.isArchived(user)) return;

    const newRoleEtat = user.role_etat == 1 ? 0 : 1;

    this.userService.updateUserRole(user.id, newRoleEtat).subscribe({
      next: () => {
        user.role_etat = newRoleEtat;
        this.cdr.detectChanges();
      },
      error: (err) => console.error('Erreur rôle', err)
    });
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
      this.userService.archiveUser(this.selectedUserId).subscribe({
        next: () => {
          this.loadUsers();
          this.closeModal();
        },
        error: (err) => {
          console.error('Erreur archivage', err);
          this.closeModal();
        }
      });
    } else {
      this.userService.unarchiveUser(this.selectedUserId).subscribe({
        next: () => {
          this.loadUsers();
          this.closeModal();
        },
        error: (err) => {
          console.error('Erreur désarchivage', err);
          this.closeModal();
        }
      });
    }
  }
}
