const gelitik = {
  // Enable to track how long visitors spent in page.
  time_track: false
}

if (!localStorage.getItem('track_id')) {
  localStorage.setItem('track_id', window.crypto.randomUUID())
}

function sendEvent(state) {
  let fd = new FormData()
  fd.append('url', window.location.href)
  fd.append('track_id', localStorage.getItem('track_id'))
  fd.append('state', state)

  fetch("/gelitik-api.php", {
    body: fd,
    method: 'post'
  })
}

window.addEventListener('load', () => {
  sendEvent('start')
})

document.addEventListener('visibilitychange', () => {
  if (gelitik.time_track) {
    sendEvent(document.visibilityState)
  }
})