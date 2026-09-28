<script setup>
import { computed, onMounted, ref } from 'vue'
import axios from 'axios'

const dataPengeluaran = ref([])

onMounted(async () => {
  try {
    const response = await axios.get(`${import.meta.env.VITE_API_URL}/pengeluaran`)
    dataPengeluaran.value = response.data
  } catch (error) {
    console.error('Error fetching data:', error)
  }
})

const totalPengeluaran = computed(() =>
  dataPengeluaran.value.reduce((total, item) => total + Number(item.amount || 0), 0)
)

const jumlahTransaksi = computed(() => dataPengeluaran.value.length)
</script>

<template>
  <section class="hero-panel">
    <div class="hero-copy">
      <span class="tag">Financial dashboard</span>
      <h2>Kelola pengeluaranmu dengan lebih jelas</h2>
      <p>
        Pantau arus kas, lihat pembelanjaan harian, dan tetap tenang dengan data yang
        tersusun rapi.
      </p>
      <div class="hero-actions">
        <button class="primary-btn">Lihat laporan</button>
        <button class="secondary-btn">Catat hari ini</button>
      </div>
    </div>

    <div class="stats-card">
      <div class="mini-stat">
        <span>Total</span>
        <strong>Rp {{ totalPengeluaran.toLocaleString('id-ID') }}</strong>
      </div>
      <div class="mini-stat">
        <span>Transaksi</span>
        <strong>{{ jumlahTransaksi }}</strong>
      </div>
      <div class="mini-stat accent">
        <span>Status</span>
        <strong>Healthy</strong>
      </div>
    </div>
  </section>

  <section class="table-panel">
    <div class="panel-header">
      <div>
        <p class="label">Ringkasan pengeluaran</p>
        <h3>Daftar transaksi terbaru</h3>
      </div>
      <span class="badge">{{ jumlahTransaksi }} item</span>
    </div>

    <div v-if="dataPengeluaran.length" class="table-wrap">
      <table class="styled-table">
        <thead>
          <tr>
            <th>Nama Pengeluaran</th>
            <th>Nominal</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in dataPengeluaran" :key="item.id">
            <td>{{ item.title }}</td>
            <td class="nominal">Rp {{ Number(item.amount || 0).toLocaleString('id-ID') }}</td>
            <td><span class="status-pill">Selesai</span></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div v-else class="empty-state">
      <div class="empty-icon">📦</div>
      <p>Belum ada data pengeluaran yang tersedia.</p>
    </div>
  </section>
</template>

<style scoped>
.hero-panel {
  display: grid;
  grid-template-columns: 1.6fr 0.9fr;
  gap: 28px;
  padding: 30px;
  border-radius: 28px;
  background: linear-gradient(135deg, rgba(34, 211, 238, 0.12), rgba(168, 85, 247, 0.12));
  border: 1px solid rgba(148, 163, 184, 0.18);
  box-shadow: 0 25px 60px rgba(15, 23, 42, 0.28);
}

.hero-copy {
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.tag {
  display: inline-flex;
  width: fit-content;
  padding: 8px 14px;
  border-radius: 999px;
  background: rgba(103, 232, 249, 0.12);
  border: 1px solid rgba(103, 232, 249, 0.2);
  color: #67e8f9;
  font-size: 0.72rem;
  font-weight: 700;
  letter-spacing: 0.08em;
  text-transform: uppercase;
}

.hero-copy h2 {
  margin: 18px 0 12px;
  font-size: clamp(2.2rem, 4vw, 3.5rem);
  line-height: 1.08;
  letter-spacing: -0.04em;
  color: #f8fafc;
}

.hero-copy p {
  max-width: 560px;
  margin: 0;
  color: #cbd5e1;
  line-height: 1.7;
  font-size: 1.02rem;
}

.hero-actions {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  margin-top: 28px;
}

.primary-btn,
.secondary-btn {
  border: none;
  cursor: pointer;
  font-weight: 700;
  border-radius: 14px;
  padding: 13px 20px;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.primary-btn {
  background: linear-gradient(135deg, #22d3ee, #8b5cf6);
  color: white;
  box-shadow: 0 18px 35px rgba(110, 86, 255, 0.35);
}

.secondary-btn {
  background: rgba(15, 23, 42, 0.35);
  color: #e2e8f0;
  border: 1px solid rgba(148, 163, 184, 0.22);
}

.primary-btn:hover,
.secondary-btn:hover {
  transform: translateY(-2px);
}

.stats-card {
  display: flex;
  flex-direction: column;
  justify-content: center;
  gap: 18px;
  padding: 22px;
  border-radius: 24px;
  background: rgba(15, 23, 42, 0.56);
  border: 1px solid rgba(148, 163, 184, 0.18);
  backdrop-filter: blur(8px);
}

.mini-stat {
  padding: 18px 16px;
  border-radius: 18px;
  background: linear-gradient(135deg, rgba(56, 189, 248, 0.14), rgba(99, 102, 241, 0.05));
  border: 1px solid rgba(148, 163, 184, 0.12);
}

.mini-stat.accent {
  background: linear-gradient(135deg, rgba(52, 211, 153, 0.17), rgba(45, 212, 191, 0.08));
}

.mini-stat span {
  display: block;
  margin-bottom: 8px;
  color: #94a3b8;
  font-size: 0.81rem;
  letter-spacing: 0.04em;
  text-transform: uppercase;
}

.mini-stat strong {
  font-size: clamp(1.2rem, 2vw, 1.7rem);
  color: #f8fafc;
}

.table-panel {
  margin-top: 28px;
  padding: 24px;
  border-radius: 28px;
  background: rgba(15, 23, 42, 0.72);
  border: 1px solid rgba(148, 163, 184, 0.16);
  box-shadow: 0 18px 50px rgba(0, 0, 0, 0.18);
}

.panel-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  margin-bottom: 18px;
}

.label {
  margin: 0 0 6px;
  color: #67e8f9;
  letter-spacing: 0.08em;
  font-size: 0.72rem;
  text-transform: uppercase;
}

.panel-header h3 {
  margin: 0;
  color: #f8fafc;
  font-size: 1.4rem;
}

.badge {
  background: rgba(168, 85, 247, 0.18);
  color: #e9d5ff;
  border: 1px solid rgba(168, 85, 247, 0.35);
  padding: 8px 12px;
  border-radius: 999px;
  font-size: 0.8rem;
  font-weight: 700;
}

.table-wrap {
  overflow-x: auto;
}

.styled-table {
  width: 100%;
  border-collapse: collapse;
  min-width: 500px;
}

.styled-table th,
.styled-table td {
  padding: 16px 18px;
  text-align: left;
  border-bottom: 1px solid rgba(148, 163, 184, 0.15);
}

.styled-table th {
  color: #cbd5e1;
  font-size: 0.74rem;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  background: rgba(30, 41, 59, 0.8);
}

.styled-table tbody tr {
  transition: background 0.2s ease;
}

.styled-table tbody tr:hover {
  background: rgba(148, 163, 184, 0.05);
}

.nominal {
  font-weight: 700;
  color: #fda4af;
}

.status-pill {
  display: inline-flex;
  align-items: center;
  padding: 7px 10px;
  border-radius: 999px;
  font-size: 0.76rem;
  font-weight: 700;
  color: #dcfce7;
  background: rgba(34, 197, 94, 0.14);
  border: 1px solid rgba(34, 197, 94, 0.3);
}

.empty-state {
  display: grid;
  place-items: center;
  min-height: 220px;
  border-radius: 18px;
  border: 1px dashed rgba(148, 163, 184, 0.25);
  background: rgba(15, 23, 42, 0.4);
  color: #cbd5e1;
  text-align: center;
}

.empty-icon {
  font-size: 2.4rem;
}

@media (max-width: 820px) {
  .hero-panel {
    grid-template-columns: 1fr;
  }

  .topbar {
    flex-direction: column;
    align-items: flex-start;
  }

  .nav {
    width: 100%;
    justify-content: center;
  }
}
</style>