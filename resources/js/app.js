import Alpine from 'alpinejs'
import { initDarkMode, toggleDarkMode, isDarkMode } from './dark-mode'
import { initPageProgress, startProgress } from './page-progress'

window.Alpine = Alpine
window.toggleDarkMode = toggleDarkMode
window.isDarkMode = isDarkMode
window.startProgress = startProgress

initDarkMode()
initPageProgress()
Alpine.start()
