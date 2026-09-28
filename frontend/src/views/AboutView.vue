<template>
  <section class="about-shell">
    <div class="about-hero">
      <span class="tag">About us</span>
      <h2>Menjadikan pengelolaan keuangan lebih ringan dan lebih jelas.</h2>
      <p>
        Aplikasi ini dibuat untuk membantu pengguna mencatat pengeluaran secara sederhana,
        cepat, dan terorganisir — tanpa ribet, tanpa membingungkan.
      </p>
    </div>

    <div class="feature-grid">
      <article class="feature-card">
        <div class="icon">⚡</div>
        <h3>Simple</h3>
        <p>Antarmuka yang mudah dipahami dan digunakan sehari-hari.</p>
      </article>

      <article class="feature-card">
        <div class="icon">📊</div>
        <h3>Transparent</h3>
        <p>Setiap pengeluaran terlihat jelas dengan data yang terstruktur.</p>
      </article>

      <article class="feature-card">
        <div class="icon">🔒</div>
        <h3>Reliable</h3>
        <p>Ditata agar proses pencatatan tetap konsisten dan aman.</p>
      </article>
    </div>
  </section>
</template>

<style scoped>
.about-shell {
  padding: 20px 0 40px;
}

.about-hero {
  padding: 36px 30px;
  border-radius: 28px;
  background: linear-gradient(135deg, rgba(56, 189, 248, 0.14), rgba(168, 85, 247, 0.14));
  border: 1px solid rgba(148, 163, 184, 0.18);
  box-shadow: 0 20px 50px rgba(15, 23, 42, 0.2);
}

.tag {
  display: inline-flex;
  padding: 8px 12px;
  border-radius: 999px;
  background: rgba(103, 232, 249, 0.1);
  border: 1px solid rgba(103, 232, 249, 0.2);
  font-size: 0.72rem;
  letter-spacing: 0.11em;
  text-transform: uppercase;
  color: #67e8f9;
  font-weight: 700;
}

.about-hero h2 {
  margin: 22px 0 12px;
  max-width: 760px;
  line-height: 1.1;
  font-size: clamp(2rem, 4vw, 3.2rem);
  color: #f8fafc;
  letter-spacing: -0.04em;
}

.about-hero p {
  max-width: 760px;
  margin: 0;
  color: #cbd5e1;
  line-height: 1.8;
  font-size: 1.03rem;
}

.feature-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 22px;
  margin-top: 28px;
}

.feature-card {
  padding: 28px 22px;
  border-radius: 24px;
  background: rgba(15, 23, 42, 0.62);
  border: 1px solid rgba(148, 163, 184, 0.14);
  box-shadow: 0 18px 40px rgba(15, 23, 42, 0.15);
}

.icon {
  width: 56px;
  height: 56px;
  border-radius: 16px;
  display: grid;
  place-items: center;
  background: linear-gradient(135deg, #22d3ee, #8b5cf6);
  font-size: 1.7rem;
  box-shadow: 0 18px 30px rgba(110, 86, 255, 0.28);
}

.feature-card h3 {
  margin: 18px 0 10px;
  font-size: 1.35rem;
  color: #f8fafc;
}

.feature-card p {
  margin: 0;
  color: #cbd5e1;
  line-height: 1.7;
}

@media (max-width: 760px) {
  .feature-grid {
    grid-template-columns: 1fr;
  }
}
</style>