const STORAGE_KEY = 'imumu-dark-mode'

export function isDarkMode() {
  return document.documentElement.classList.contains('dark')
}

export function toggleDarkMode() {
  const isDark = document.documentElement.classList.toggle('dark')
  document.body.classList.toggle('dark', isDark)
  const bg = isDark ? '#1a1a2e' : '#FFF5F7'
  document.documentElement.style.backgroundColor = bg
  document.body.style.backgroundColor = bg
  localStorage.setItem(STORAGE_KEY, isDark ? 'true' : 'false')
  return isDark
}

export function initDarkMode() {
  window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
    if (localStorage.getItem(STORAGE_KEY) !== null) return
    const on = e.matches
    const bg = on ? '#1a1a2e' : '#FFF5F7'
    document.documentElement.classList.toggle('dark', on)
    document.documentElement.style.backgroundColor = bg
    document.body.classList.toggle('dark', on)
    document.body.style.backgroundColor = bg
  })
}
