declare module '*.vue' {
  import type { DefineComponent } from 'vue'
  const component: DefineComponent<{}, {}, any>
  return component
}

declare module './router' {
  import { Router } from 'vue-router'
  const router: Router
  export default router
}