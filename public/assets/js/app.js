/**
 * SMECONE Archery Club - Main Application Script
 * Handles navigation, mobile drawer, modals, toast system, and export utilities
 */

const SACApp = (() => {
  // Navigation Links Definition
  const NAV_ITEMS = [
    { label: "Beranda", path: "index.html", icon: "home" },
    { label: "Kepengurusan", path: "kepengurusan.html", icon: "groups" },
    { label: "Anggota", path: "anggota.html", icon: "badge" },
    { label: "Absensi", path: "absensi.html", icon: "how_to_reg" },
    { label: "Iuran", path: "iuran.html", icon: "payments" },
    { label: "Jadwal", path: "jadwal.html", icon: "calendar_month" },
    { label: "Admin Dashboard", path: "admin.html", icon: "dashboard", adminOnly: false }
  ];

  // Initialize Toast Container
  function ensureToastContainer() {
    let container = document.getElementById('sac-toast-container');
    if (!container) {
      container = document.createElement('div');
      container.id = 'sac-toast-container';
      container.className = 'sac-toast-container';
      document.body.appendChild(container);
    }
    return container;
  }

  // Toast Notification
  function showToast(message, type = 'success', duration = 3500) {
    const container = ensureToastContainer();
    const toast = document.createElement('div');
    toast.className = `sac-toast toast-${type}`;

    let iconName = 'check_circle';
    if (type === 'error') iconName = 'error';
    if (type === 'info') iconName = 'info';

    toast.innerHTML = `
      <div class="sac-toast-icon">
        <span class="material-symbols-outlined text-[20px]">${iconName}</span>
      </div>
      <div class="flex-1 text-sm font-medium leading-snug">${message}</div>
      <button class="text-on-surface-variant hover:text-on-surface text-xs p-1" onclick="this.parentElement.remove()">
        <span class="material-symbols-outlined text-[16px]">close</span>
      </button>
    `;

    container.appendChild(toast);

    setTimeout(() => {
      toast.classList.add('toast-leave');
      setTimeout(() => toast.remove(), 260);
    }, duration);
  }

  // Export Array to CSV file for Excel
  function exportToCSV(filename, headers, rows) {
    const processRow = (row) => {
      return row.map(val => {
        let text = (val === null || val === undefined) ? '' : String(val);
        text = text.replace(/"/g, '""');
        return `"${text}"`;
      }).join(',');
    };

    let csvContent = '\uFEFF'; // UTF-8 BOM for Microsoft Excel
    csvContent += headers.map(h => `"${h.replace(/"/g, '""')}"`).join(',') + '\r\n';
    rows.forEach(r => {
      csvContent += processRow(r) + '\r\n';
    });

    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.setAttribute('href', url);
    link.setAttribute('download', filename.endsWith('.csv') ? filename : `${filename}.csv`);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);

    showToast(`File ${filename} berhasil diunduh!`, 'success');
  }

  // Mobile Drawer Toggle
  function toggleMobileDrawer(open) {
    const overlay = document.getElementById('mobile-drawer-overlay');
    const drawer = document.getElementById('mobile-drawer');
    if (!overlay || !drawer) return;

    if (open) {
      overlay.classList.remove('hidden');
      setTimeout(() => {
        overlay.classList.remove('opacity-0');
        drawer.classList.remove('-translate-x-full');
      }, 10);
      document.body.style.overflow = 'hidden';
    } else {
      overlay.classList.add('opacity-0');
      drawer.classList.add('-translate-x-full');
      setTimeout(() => {
        overlay.classList.add('hidden');
        document.body.style.overflow = '';
      }, 300);
    }
  }

  // Modal Controllers
  function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    const content = modal.querySelector('.modal-box') || modal.firstElementChild;
    if (content) content.classList.add('modal-content-animated');
    document.body.style.overflow = 'hidden';
  }

  function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;
    modal.classList.remove('flex');
    modal.classList.add('hidden');
    document.body.style.overflow = '';
  }

  // Setup Global Keyboard & Backdrop Listeners for Modals
  function setupModalListeners() {
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        const visibleModals = document.querySelectorAll('.fixed.z-50:not(.hidden)');
        visibleModals.forEach(m => {
          if (m.id !== 'mobile-drawer-overlay') {
            closeModal(m.id);
          }
        });
        toggleMobileDrawer(false);
      }
    });

    // Close on backdrop click
    document.addEventListener('click', (e) => {
      if (e.target.hasAttribute('data-modal-backdrop')) {
        closeModal(e.target.id);
      }
    });
  }

  // Inject Login Modal into DOM
  function ensureLoginModal() {
    if (document.getElementById('sac-login-modal')) return;

    const modal = document.createElement('div');
    modal.id = 'sac-login-modal';
    modal.setAttribute('data-modal-backdrop', 'true');
    modal.className = 'fixed inset-0 z-50 hidden items-center justify-center modal-backdrop p-4';
    modal.innerHTML = `
      <div class="modal-box bg-surface-container-lowest max-w-md w-full rounded-2xl shadow-2xl p-6 relative border border-outline-variant/30" onclick="event.stopPropagation()">
        <button class="absolute top-4 right-4 text-on-surface-variant hover:text-on-surface p-1 rounded-lg" onclick="SACApp.closeModal('sac-login-modal')">
          <span class="material-symbols-outlined">close</span>
        </button>
        <div class="flex items-center gap-3 mb-4">
          <div class="w-12 h-12 rounded-xl bg-primary text-on-primary flex items-center justify-center font-headline-sm">SAC</div>
          <div>
            <h3 class="font-headline-sm text-on-surface">Portal Akses SAC</h3>
            <p class="text-body-sm text-on-surface-variant">SMECONE Archery Club</p>
          </div>
        </div>
        
        <p class="text-body-sm text-on-surface-variant mb-6">Pilih peran akun Anda untuk menguji fitur dengan wewenang yang sesuai:</p>
        
        <div class="space-y-3 mb-6">
          <button class="w-full p-4 rounded-xl border border-primary/20 bg-primary/5 hover:bg-primary/10 transition-all flex items-center justify-between text-left group" onclick="SACApp.loginAs('admin')">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-lg bg-primary text-on-primary flex items-center justify-center">
                <span class="material-symbols-outlined text-[20px]">admin_panel_settings</span>
              </div>
              <div>
                <div class="font-label-lg text-primary font-bold">Administrator / Coach</div>
                <div class="text-body-sm text-on-surface-variant">Akses penuh input absensi, iuran, & data</div>
              </div>
            </div>
            <span class="material-symbols-outlined text-primary group-hover:translate-x-1 transition-transform">arrow_forward</span>
          </button>
          
          <button class="w-full p-4 rounded-xl border border-outline-variant/30 bg-surface-container-low hover:bg-surface-container transition-all flex items-center justify-between text-left group" onclick="SACApp.loginAs('member')">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-lg bg-primary-container text-on-primary-container flex items-center justify-center">
                <span class="material-symbols-outlined text-[20px]">person</span>
              </div>
              <div>
                <div class="font-label-lg text-on-surface font-semibold">Anggota / Siswa Atlet</div>
                <div class="text-body-sm text-on-surface-variant">Cek absensi mandiri, tagihan iuran, dan jadwal</div>
              </div>
            </div>
            <span class="material-symbols-outlined text-on-surface-variant group-hover:translate-x-1 transition-transform">arrow_forward</span>
          </button>
        </div>

        <div class="pt-3 border-t border-outline-variant/20 flex justify-between items-center text-xs text-on-surface-variant">
          <span>Status: Terhubung ke LocalStorage</span>
          <button class="text-error hover:underline text-xs" onclick="if(confirm('Reset semua data kembali ke default awal?')) { SACStore.resetStore(); }">Reset Data Awal</button>
        </div>
      </div>
    `;
    document.body.appendChild(modal);
  }

  // Handle Login switch
  function loginAs(role) {
    if (role === 'admin') {
      SACStore.setAuth({
        isLoggedIn: true,
        user: {
          name: "Coach Arief Ritade, S.Pd.I",
          role: "Administrator / Pembina",
          avatar: "https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80"
        }
      });
      showToast('Berhasil login sebagai Administrator!', 'success');
    } else {
      SACStore.setAuth({
        isLoggedIn: true,
        user: {
          name: "Bondan Pandu Hakim",
          role: "Ketua Klub / Atlet",
          avatar: "https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=100&auto=format&fit=crop&q=80"
        }
      });
      showToast('Berhasil login sebagai Anggota Atlet!', 'info');
    }
    closeModal('sac-login-modal');
    updateAuthUI();
  }

  // Update Auth UI indicators in navbar
  function updateAuthUI() {
    const auth = SACStore.getAuth();
    const loginBtns = document.querySelectorAll('[data-auth-trigger]');
    loginBtns.forEach(btn => {
      if (auth.isLoggedIn) {
        btn.innerHTML = `
          <span class="text-xs hidden sm:inline font-medium">${auth.user.name.split(' ')[0]} (${auth.user.role.split(' ')[0]})</span>
          <span class="material-symbols-outlined text-[18px]">verified_user</span>
        `;
      } else {
        btn.innerHTML = `
          <span>Login</span>
          <span class="material-symbols-outlined text-[18px]">login</span>
        `;
      }
    });
  }

  // Initialize UI on page load
  function init(activePage) {
    ensureToastContainer();
    ensureLoginModal();
    setupModalListeners();
    updateAuthUI();

    // Setup active state for navigation links
    const currentPath = activePage || window.location.pathname.split('/').pop() || 'index.html';
    const navLinks = document.querySelectorAll('header nav a, #mobile-drawer nav a');
    navLinks.forEach(link => {
      const linkPath = link.getAttribute('href');
      if (linkPath === currentPath || (currentPath === '' && linkPath === 'index.html')) {
        link.className = 'transition-all bg-primary-container text-on-primary-container font-semibold rounded-lg px-3 py-2 flex items-center gap-2';
        link.setAttribute('aria-current', 'page');
      }
    });
  }

  return {
    init,
    toast: showToast,
    openModal,
    closeModal,
    toggleMobileDrawer,
    exportToCSV,
    loginAs,
    updateAuthUI
  };
})();

// Auto initialize on DOM ready
document.addEventListener('DOMContentLoaded', () => {
  const pagePath = window.location.pathname.split('/').pop();
  SACApp.init(pagePath);
});
