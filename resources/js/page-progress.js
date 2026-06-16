const BAR_ID = 'page-progress'

function bar() {
  return document.getElementById(BAR_ID)
}

export function startProgress() {
  const el = bar()
  if (!el) return
  el.classList.remove('opacity-0')
  el.style.transitionDuration = '150ms'
  el.style.width = '40%'
}

export function initPageProgress() {
  const el = bar()
  if (!el) return

  el.classList.remove('opacity-0')
  el.style.width = '0%'

  requestAnimationFrame(() => {
    el.style.width = '70%'
  })

  function done() {
    el.style.width = '100%'
    el.style.transitionDuration = '200ms'
    setTimeout(() => {
      el.style.opacity = '0'
      el.style.transitionDuration = '300ms'
      setTimeout(() => { el.style.width = '0%' }, 300)
    }, 200)
  }

  if (document.readyState === 'complete') {
    setTimeout(done, 100)
  } else {
    window.addEventListener('load', done)
  }
}
