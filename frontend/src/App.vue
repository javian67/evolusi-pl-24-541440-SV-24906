<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <div class="app-shell">
    <header class="topbar">
      <div class="brand-wrap">
        <div class="brand-mark">₹</div>
        <div>
          <p class="eyebrow">Finance Flow</p>
          <h1>Budget Insight</h1>
        </div>
      </div>

      <nav class="nav">
        <RouterLink to="/" class="nav-link">Home</RouterLink>
        <RouterLink to="/about" class="nav-link">About</RouterLink>
      </nav>
    </header>

    <main class="page-content">
      <RouterView />
    </main>
  </div>
</template>

<style scoped>
.app-shell {
  min-height: 100vh;
  background:
    radial-gradient(circle at top left, rgba(94, 234, 212, 0.25), transparent 35%),
    radial-gradient(circle at right center, rgba(129, 140, 248, 0.28), transparent 30%),
    linear-gradient(135deg, #0f172a 0%, #111827 35%, #1e293b 100%);
  color: #e2e8f0;
}

.topbar {
  max-width: 1180px;
  margin: 0 auto;
  padding: 22px 24px 18px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 18px;
}

.brand-wrap {
  display: flex;
  align-items: center;
  gap: 14px;
}

.brand-mark {
  width: 48px;
  height: 48px;
  border-radius: 16px;
  display: grid;
  place-items: center;
  font-size: 1.5rem;
  font-weight: 800;
  color: #0f172a;
  background: linear-gradient(135deg, #67e8f9, #a78bfa, #f9a8d4);
  box-shadow: 0 14px 30px rgba(103, 232, 249, 0.35);
}

.eyebrow {
  margin: 0;
  font-size: 0.72rem;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: #9fb2d2;
}

h1 {
  margin: 4px 0 0;
  font-size: clamp(1.2rem, 2vw, 1.8rem);
  font-weight: 700;
}

.nav {
  display: flex;
  gap: 12px;
  padding: 8px;
  border-radius: 999px;
  background: rgba(15, 23, 42, 0.5);
  border: 1px solid rgba(148, 163, 184, 0.18);
  backdrop-filter: blur(10px);
}

.nav-link {
  padding: 10px 18px;
  border-radius: 999px;
  color: #dbeafe;
  text-decoration: none;
  font-weight: 600;
  transition: all 0.2s ease;
}

.nav-link:hover,
.nav-link.router-link-active {
  background: linear-gradient(135deg, #22d3ee, #8b5cf6);
  color: white;
  box-shadow: 0 10px 24px rgba(110, 86, 255, 0.35);
}

.page-content {
  max-width: 1180px;
  margin: 0 auto;
  padding: 20px 24px 48px;
}
</style>