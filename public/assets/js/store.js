/**
 * SMECONE Archery Club - Central Reactive Data Store
 * Persists all state across all pages via localStorage
 */

const SACStore = (() => {
  const STORAGE_KEYS = {
    MEMBERS: 'sac_members_v1',
    ATTENDANCE: 'sac_attendance_v1',
    FINANCES: 'sac_finances_v1',
    SCHEDULES: 'sac_schedules_v1',
    ACTIVITIES: 'sac_activities_v1',
    ANNOUNCEMENTS: 'sac_announcements_v1',
    AUTH: 'sac_auth_v1'
  };

  // Initial Seeder Data
  const defaultMembers = [
    {
      id: "SAC-001",
      name: "Bondan Pandu Hakim",
      nisn: "0068192831",
      class: "XII RPL 1",
      division: "Recurve",
      role: "Ketua Klub",
      phone: "081234567890",
      status: "Aktif",
      attendanceRate: 96,
      avatar: "https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=200&auto=format&fit=crop&q=80",
      duesStatus: "Lunas",
      joinDate: "2024-07-15"
    },
    {
      id: "SAC-002",
      name: "Sibli Irawan Al Kaafi",
      nisn: "0068192832",
      class: "XII TKJ 2",
      division: "Compound",
      role: "Wakil Ketua",
      phone: "081234567891",
      status: "Aktif",
      attendanceRate: 94,
      avatar: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&auto=format&fit=crop&q=80",
      duesStatus: "Lunas",
      joinDate: "2024-07-15"
    },
    {
      id: "SAC-003",
      name: "Indri Clarissa Candraningtyas",
      nisn: "0078192833",
      class: "XI AKL 1",
      division: "Recurve",
      role: "Sekretaris 1",
      phone: "081234567892",
      status: "Aktif",
      attendanceRate: 98,
      avatar: "https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=200&auto=format&fit=crop&q=80",
      duesStatus: "Lunas",
      joinDate: "2024-08-01"
    },
    {
      id: "SAC-004",
      name: "Naura Syifa Azzahra",
      nisn: "0078192834",
      class: "XI OTKP 2",
      division: "Standard Bow",
      role: "Sekretaris 2",
      phone: "081234567893",
      status: "Aktif",
      attendanceRate: 92,
      avatar: "https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=200&auto=format&fit=crop&q=80",
      duesStatus: "Lunas",
      joinDate: "2024-08-01"
    },
    {
      id: "SAC-005",
      name: "Dwi Kurniawati",
      nisn: "0078192835",
      class: "XI BDP 1",
      division: "Barebow",
      role: "Bendahara",
      phone: "081234567894",
      status: "Aktif",
      attendanceRate: 100,
      avatar: "https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=200&auto=format&fit=crop&q=80",
      duesStatus: "Lunas",
      joinDate: "2024-08-01"
    },
    {
      id: "SAC-006",
      name: "Ahmad Rizky Pratama",
      nisn: "0088192836",
      class: "X RPL 2",
      division: "Recurve",
      role: "Anggota",
      phone: "081234567895",
      status: "Aktif",
      attendanceRate: 90,
      avatar: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=200&auto=format&fit=crop&q=80",
      duesStatus: "Lunas",
      joinDate: "2025-07-20"
    },
    {
      id: "SAC-007",
      name: "Siti Nurhaliza",
      nisn: "0088192837",
      class: "X MM 1",
      division: "Compound",
      role: "Anggota",
      phone: "081234567896",
      status: "Aktif",
      attendanceRate: 88,
      avatar: "https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=200&auto=format&fit=crop&q=80",
      duesStatus: "Belum Lunas",
      joinDate: "2025-07-20"
    },
    {
      id: "SAC-008",
      name: "Dimas Prasetyo",
      nisn: "0088192838",
      class: "X TKJ 1",
      division: "Standard Bow",
      role: "Anggota",
      phone: "081234567897",
      status: "Aktif",
      attendanceRate: 85,
      avatar: "https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?w=200&auto=format&fit=crop&q=80",
      duesStatus: "Lunas",
      joinDate: "2025-07-20"
    },
    {
      id: "SAC-009",
      name: "Fauzan Al-Ghifari",
      nisn: "0078192839",
      class: "XI RPL 1",
      division: "Recurve",
      role: "Anggota",
      phone: "081234567898",
      status: "Aktif",
      attendanceRate: 95,
      avatar: "https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=200&auto=format&fit=crop&q=80",
      duesStatus: "Lunas",
      joinDate: "2024-08-10"
    },
    {
      id: "SAC-010",
      name: "Putri Anggraini",
      nisn: "0088192840",
      class: "X AKL 2",
      division: "Barebow",
      role: "Anggota",
      phone: "081234567899",
      status: "Aktif",
      attendanceRate: 82,
      avatar: "https://images.unsplash.com/photo-1517841905240-472988babdf9?w=200&auto=format&fit=crop&q=80",
      duesStatus: "Belum Lunas",
      joinDate: "2025-07-22"
    },
    {
      id: "SAC-011",
      name: "Bagas Satria Wibowo",
      nisn: "0068192841",
      class: "XII RPL 2",
      division: "Recurve",
      role: "Alumni / Senior",
      phone: "081234567800",
      status: "Non-Aktif",
      attendanceRate: 70,
      avatar: "https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=200&auto=format&fit=crop&q=80",
      duesStatus: "Lunas",
      joinDate: "2023-07-15"
    },
    {
      id: "SAC-012",
      name: "Tiara Anindya",
      nisn: "0068192842",
      class: "XII BDP 2",
      division: "Compound",
      role: "Alumni / Senior",
      phone: "081234567801",
      status: "Non-Aktif",
      attendanceRate: 65,
      avatar: "https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=200&auto=format&fit=crop&q=80",
      duesStatus: "Belum Lunas",
      joinDate: "2023-07-15"
    }
  ];

  const defaultAttendance = [
    {
      id: "ATT-101",
      date: "2026-09-24",
      time: "15:42 WIB",
      memberId: "SAC-001",
      memberName: "Bondan Pandu Hakim",
      memberClass: "XII RPL 1",
      division: "Recurve",
      status: "hadir",
      notes: "Tepat waktu, sesi scoring target 18m"
    },
    {
      id: "ATT-102",
      date: "2026-09-24",
      time: "15:45 WIB",
      memberId: "SAC-002",
      memberName: "Sibli Irawan Al Kaafi",
      memberClass: "XII TKJ 2",
      division: "Compound",
      status: "hadir",
      notes: "Tuning alat & stringing"
    },
    {
      id: "ATT-103",
      date: "2026-09-24",
      time: "15:46 WIB",
      memberId: "SAC-003",
      memberName: "Indri Clarissa Candraningtyas",
      memberClass: "XI AKL 1",
      division: "Recurve",
      status: "hadir",
      notes: "Hadir lengkap"
    },
    {
      id: "ATT-104",
      date: "2026-09-24",
      time: "15:48 WIB",
      memberId: "SAC-004",
      memberName: "Naura Syifa Azzahra",
      memberClass: "XI OTKP 2",
      division: "Standard Bow",
      status: "hadir",
      notes: "Latihan form & release"
    },
    {
      id: "ATT-105",
      date: "2026-09-24",
      time: "15:50 WIB",
      memberId: "SAC-005",
      memberName: "Dwi Kurniawati",
      memberClass: "XI BDP 1",
      division: "Barebow",
      status: "hadir",
      notes: "Hadir on time"
    },
    {
      id: "ATT-106",
      date: "2026-09-24",
      time: "15:52 WIB",
      memberId: "SAC-006",
      memberName: "Ahmad Rizky Pratama",
      memberClass: "X RPL 2",
      division: "Recurve",
      status: "hadir",
      notes: "Latihan fisik dan anchor point"
    },
    {
      id: "ATT-107",
      date: "2026-09-24",
      time: "15:30 WIB",
      memberId: "SAC-007",
      memberName: "Siti Nurhaliza",
      memberClass: "X MM 1",
      division: "Compound",
      status: "izin",
      notes: "Ada tugas remidial mata pelajaran Matematika"
    },
    {
      id: "ATT-108",
      date: "2026-09-24",
      time: "14:10 WIB",
      memberId: "SAC-008",
      memberName: "Dimas Prasetyo",
      memberClass: "X TKJ 1",
      division: "Standard Bow",
      status: "sakit",
      notes: "Demam, surat dokter sudah dikirim via WA Coach"
    },
    {
      id: "ATT-109",
      date: "2026-09-24",
      time: "15:55 WIB",
      memberId: "SAC-009",
      memberName: "Fauzan Al-Ghifari",
      memberClass: "XI RPL 1",
      division: "Recurve",
      status: "hadir",
      notes: "Persiapan seleksi POPDA"
    },
    {
      id: "ATT-110",
      date: "2026-09-24",
      time: "15:58 WIB",
      memberId: "SAC-010",
      memberName: "Putri Anggraini",
      memberClass: "X AKL 2",
      division: "Barebow",
      status: "hadir",
      notes: "Target panahan 10m dasar"
    }
  ];

  const defaultFinances = {
    balance: 4850000,
    monthlyTarget: 5000000,
    duesFeePerMonth: 25000,
    transactions: [
      {
        id: "TRX-001",
        date: "2026-09-23",
        memberId: "SAC-001",
        memberName: "Bondan Pandu Hakim",
        type: "masuk",
        category: "Iuran Bulanan",
        amount: 25000,
        period: "September 2026",
        method: "QRIS",
        status: "Lunas"
      },
      {
        id: "TRX-002",
        date: "2026-09-22",
        memberId: "SAC-003",
        memberName: "Indri Clarissa Candraningtyas",
        type: "masuk",
        category: "Iuran Bulanan",
        amount: 25000,
        period: "September 2026",
        method: "Transfer",
        status: "Lunas"
      },
      {
        id: "TRX-003",
        date: "2026-09-20",
        memberId: "SAC-006",
        memberName: "Ahmad Rizky Pratama",
        type: "masuk",
        category: "Iuran Bulanan",
        amount: 25000,
        period: "September 2026",
        method: "Tunai",
        status: "Lunas"
      },
      {
        id: "TRX-004",
        date: "2026-09-18",
        memberId: "SYSTEM",
        memberName: "Pembelian Target Face & Bantalan",
        type: "keluar",
        category: "Perawatan & Alat",
        amount: 450000,
        period: "September 2026",
        method: "Transfer",
        status: "Selesai"
      },
      {
        id: "TRX-005",
        date: "2026-09-15",
        memberId: "SAC-009",
        memberName: "Fauzan Al-Ghifari",
        type: "masuk",
        category: "Iuran Bulanan",
        amount: 25000,
        period: "September 2026",
        method: "Tunai",
        status: "Lunas"
      }
    ]
  };

  const defaultSchedules = [
    {
      id: "SCH-01",
      day: "Sel",
      dayName: "Selasa",
      dateNum: "24",
      fullDate: "24 September 2026",
      time: "15:30 - 17:30 WIB",
      title: "Teknik Dasar & Posisi Tubuh (Form)",
      category: "recurve",
      categoryLabel: "Recurve / Nasional",
      location: "Lapangan Utama SMKN 1",
      coach: "Coach Arief Ritade, S.Pd.I",
      description: "Fokus pada tarikan tali, jangkar, dan pelepasan panah yang konsisten.",
      attendeesCount: 28,
      status: "Berlangsung"
    },
    {
      id: "SCH-02",
      day: "Kam",
      dayName: "Kamis",
      dateNum: "26",
      fullDate: "26 September 2026",
      time: "15:30 - 17:30 WIB",
      title: "Simulasi Pertandingan (Scoring Round)",
      category: "compound",
      categoryLabel: "Compound & Barebow",
      location: "Indoor Hall SMKN 1",
      coach: "Coach Bambang & Tim",
      description: "Latihan memanah jarak 18 meter dengan sistem penilaian resmi perorangan.",
      attendeesCount: 24,
      status: "Mendatang"
    },
    {
      id: "SCH-03",
      day: "Sab",
      dayName: "Sabtu",
      dateNum: "28",
      fullDate: "28 September 2026",
      time: "08:00 - 11:00 WIB",
      title: "Conditioning & Mental Focus",
      category: "all",
      categoryLabel: "Semua Kategori",
      location: "Lapangan Outdoor SAC SMKN 1",
      coach: "Coach Arief & Pelatih Fisik",
      description: "Latihan fisik penguatan otot punggung, bahu, dan konsentrasi konsistensi tembakan.",
      attendeesCount: 35,
      status: "Mendatang"
    },
    {
      id: "SCH-04",
      day: "Min",
      dayName: "Minggu",
      dateNum: "29",
      fullDate: "29 September 2026",
      time: "07:30 - 10:30 WIB",
      title: "Sparring Internal & Evaluasi Tim POPDA",
      category: "recurve",
      categoryLabel: "Khusus Atlet POPDA",
      location: "Lapangan Luar GOR Satria Purwokerto",
      coach: "Coach Arief & Official SAC",
      description: "Uji coba scoring jarak 30m, 50m dan eliminasi 1 on 1.",
      attendeesCount: 12,
      status: "Mendatang"
    }
  ];

  const defaultActivities = [
    {
      id: "ACT-01",
      title: "Sparring Internal Antar Anggota",
      date: "15 September 2026",
      image: "https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=600&auto=format&fit=crop&q=80",
      description: "Menguji mental tanding dan akurasi tembakan antar anggota klub dalam suasana kompetitif namun kekeluargaan.",
      category: "Kompetisi",
      location: "Lapangan SMKN 1 Purwokerto"
    },
    {
      id: "ACT-02",
      title: "Workshop Perawatan & Tuning Alat Panahan",
      date: "10 September 2026",
      image: "https://images.unsplash.com/photo-1518611012118-696072aa579a?w=600&auto=format&fit=crop&q=80",
      description: "Pelatihan pemeliharaan string, rest, nock point, dan tuning busur panah agar performa peralatan tetap optimal dan awet.",
      category: "Edukasi",
      location: "Bengkel Panahan SAC"
    },
    {
      id: "ACT-03",
      title: "Orientasi Anggota Baru Angkatan 2026",
      date: "05 September 2026",
      image: "https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?w=600&auto=format&fit=crop&q=80",
      description: "Penyambutan dan pengenalan dasar-dasar keselamatan (archery safety rules) serta pengenalan alat bagi anggota baru.",
      category: "Penyambutan",
      location: "Aula SMKN 1 Purwokerto"
    }
  ];

  const defaultAnnouncements = [
    {
      id: "ANN-01",
      title: "Latihan Minggu Ini Dipindahkan ke Kamis",
      date: "22 Sep 2026",
      tag: "Penting",
      content: "Sehubungan dengan adanya kegiatan sekolah di lapangan utama pada hari Selasa sore, seluruh sesi latihan dipindahkan ke Kamis sore jam 15:30 WIB."
    },
    {
      id: "ANN-02",
      title: "Seleksi Tim Pekan Olahraga Pelajar (POPDA)",
      date: "18 Sep 2026",
      tag: "Kejuaraan",
      content: "Pendaftaran seleksi internal untuk mewakili sekolah pada ajang POPDA Banyumas telah dibuka untuk nomor Recurve & Compound. Silakan hubungi Coach Arief."
    },
    {
      id: "ANN-03",
      title: "Pengecekan Rutin Inventaris Busur dan Arrow",
      date: "12 Sep 2026",
      tag: "Inventaris",
      content: "Seluruh anggota yang meminjam alat panahan inventaris sekolah wajib membawa perlengkapannya pada hari Sabtu untuk servis berkala."
    }
  ];

  // Helper to load or initialize
  function load(key, fallback) {
    try {
      const data = localStorage.getItem(key);
      if (data) return JSON.parse(data);
    } catch (e) {
      console.warn("Error reading from localStorage:", e);
    }
    localStorage.setItem(key, JSON.stringify(fallback));
    return fallback;
  }

  function save(key, data) {
    try {
      localStorage.setItem(key, JSON.stringify(data));
      window.dispatchEvent(new CustomEvent('sac-store-updated', { detail: { key, data } }));
    } catch (e) {
      console.error("Error saving to localStorage:", e);
    }
  }

  return {
    // Member Operations
    getMembers() {
      return load(STORAGE_KEYS.MEMBERS, defaultMembers);
    },
    getMemberById(id) {
      return this.getMembers().find(m => m.id === id);
    },
    addMember(memberData) {
      const members = this.getMembers();
      const newId = `SAC-0${(members.length + 1).toString().padStart(2, '0')}`;
      const newMember = {
        id: newId,
        attendanceRate: 100,
        duesStatus: "Belum Lunas",
        joinDate: new Date().toISOString().split('T')[0],
        avatar: memberData.avatar || `https://api.dicebear.com/7.x/avataaars/svg?seed=${encodeURIComponent(memberData.name)}`,
        status: "Aktif",
        ...memberData
      };
      members.unshift(newMember);
      save(STORAGE_KEYS.MEMBERS, members);
      return newMember;
    },
    updateMember(id, updatedData) {
      const members = this.getMembers();
      const idx = members.findIndex(m => m.id === id);
      if (idx !== -1) {
        members[idx] = { ...members[idx], ...updatedData };
        save(STORAGE_KEYS.MEMBERS, members);
        return members[idx];
      }
      return null;
    },
    deleteMember(id) {
      let members = this.getMembers();
      members = members.filter(m => m.id !== id);
      save(STORAGE_KEYS.MEMBERS, members);
    },

    // Attendance Operations
    getAttendance() {
      return load(STORAGE_KEYS.ATTENDANCE, defaultAttendance);
    },
    recordAttendance(attendanceData) {
      const attendance = this.getAttendance();
      const newRecord = {
        id: `ATT-${Date.now().toString().slice(-4)}`,
        date: attendanceData.date || new Date().toISOString().split('T')[0],
        time: `${new Date().getHours().toString().padStart(2, '0')}:${new Date().getMinutes().toString().padStart(2, '0')} WIB`,
        status: attendanceData.status || "hadir",
        notes: attendanceData.notes || "-",
        ...attendanceData
      };
      attendance.unshift(newRecord);
      save(STORAGE_KEYS.ATTENDANCE, attendance);

      // Re-calculate attendance rate for member
      const member = this.getMemberById(newRecord.memberId);
      if (member) {
        const memberLogs = attendance.filter(a => a.memberId === newRecord.memberId);
        const presentCount = memberLogs.filter(a => a.status === 'hadir').length;
        const rate = Math.round((presentCount / memberLogs.length) * 100) || 100;
        this.updateMember(newRecord.memberId, { attendanceRate: rate });
      }

      return newRecord;
    },
    deleteAttendance(id) {
      let attendance = this.getAttendance();
      attendance = attendance.filter(a => a.id !== id);
      save(STORAGE_KEYS.ATTENDANCE, attendance);
    },
    getTodayAttendanceStats(dateStr) {
      const today = dateStr || new Date().toISOString().split('T')[0];
      const logs = this.getAttendance().filter(a => a.date === today);
      const totalMembers = this.getMembers().filter(m => m.status === 'Aktif').length;

      const hadir = logs.filter(a => a.status === 'hadir').length;
      const izin = logs.filter(a => a.status === 'izin').length;
      const sakit = logs.filter(a => a.status === 'sakit').length;
      const recorded = logs.length;
      const alpha = Math.max(0, totalMembers - (hadir + izin + sakit));

      const rate = totalMembers > 0 ? Math.round((hadir / totalMembers) * 100) : 0;
      return { hadir, izin, sakit, alpha, totalMembers, rate, logs };
    },

    // Finances Operations
    getFinances() {
      return load(STORAGE_KEYS.FINANCES, defaultFinances);
    },
    addPayment(paymentData) {
      const finances = this.getFinances();
      const amount = parseInt(paymentData.amount) || 25000;
      const isIncome = paymentData.type !== 'keluar';

      const newTx = {
        id: `TRX-${Date.now().toString().slice(-4)}`,
        date: paymentData.date || new Date().toISOString().split('T')[0],
        type: isIncome ? 'masuk' : 'keluar',
        amount: amount,
        category: paymentData.category || "Iuran Bulanan",
        period: paymentData.period || "September 2026",
        method: paymentData.method || "Tunai",
        status: "Lunas",
        ...paymentData
      };

      finances.transactions.unshift(newTx);
      if (isIncome) {
        finances.balance += amount;
      } else {
        finances.balance -= amount;
      }

      save(STORAGE_KEYS.FINANCES, finances);

      // If tied to member, mark member dues as Lunas
      if (paymentData.memberId && isIncome) {
        this.updateMember(paymentData.memberId, { duesStatus: "Lunas" });
      }

      return newTx;
    },

    // Schedules Operations
    getSchedules() {
      return load(STORAGE_KEYS.SCHEDULES, defaultSchedules);
    },
    addSchedule(scheduleData) {
      const schedules = this.getSchedules();
      const newSchedule = {
        id: `SCH-0${schedules.length + 1}`,
        attendeesCount: 0,
        status: "Mendatang",
        ...scheduleData
      };
      schedules.push(newSchedule);
      save(STORAGE_KEYS.SCHEDULES, schedules);
      return newSchedule;
    },

    // Activities & Announcements
    getActivities() {
      return load(STORAGE_KEYS.ACTIVITIES, defaultActivities);
    },
    getAnnouncements() {
      return load(STORAGE_KEYS.ANNOUNCEMENTS, defaultAnnouncements);
    },

    // Auth Simulation
    getAuth() {
      return load(STORAGE_KEYS.AUTH, {
        isLoggedIn: true,
        user: {
          name: "Admin SMECONE",
          role: "Administrator",
          avatar: "https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80"
        }
      });
    },
    setAuth(authData) {
      save(STORAGE_KEYS.AUTH, authData);
    },

    // Global Stats Aggregator
    getOverviewStats() {
      const members = this.getMembers();
      const activeMembers = members.filter(m => m.status === 'Aktif').length;
      const schedules = this.getSchedules();
      const finances = this.getFinances();
      const todayStats = this.getTodayAttendanceStats();
      const unpaidMembers = members.filter(m => m.duesStatus !== 'Lunas').length;

      return {
        totalMembers: members.length,
        activeMembers: activeMembers,
        schedulesCount: schedules.length,
        balanceFormatted: new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(finances.balance),
        balanceRaw: finances.balance,
        unpaidCount: unpaidMembers,
        todayHadir: todayStats.hadir,
        todayAttendanceRate: todayStats.rate,
        totalMedals: 24,
        totalActivities: this.getActivities().length
      };
    },

    // Reset store to default
    resetStore() {
      localStorage.removeItem(STORAGE_KEYS.MEMBERS);
      localStorage.removeItem(STORAGE_KEYS.ATTENDANCE);
      localStorage.removeItem(STORAGE_KEYS.FINANCES);
      localStorage.removeItem(STORAGE_KEYS.SCHEDULES);
      localStorage.removeItem(STORAGE_KEYS.ACTIVITIES);
      localStorage.removeItem(STORAGE_KEYS.ANNOUNCEMENTS);
      localStorage.removeItem(STORAGE_KEYS.AUTH);
      window.location.reload();
    }
  };
})();

// Expose globally
window.SACStore = SACStore;
