addEventListener('load', async () => {
  await navigator.serviceWorker.register('sw.js', {scope: '/'})
    .then((registration) => registration.pushManager.getSubscription()
      .then(async (subscription) => {

      }));
  await Notification.requestPermission((permission) => {
    if (permission === 'granted') {
      subscribe();
    }
  });
});


if ('permissions' in navigator) {
  navigator.permissions.query({name: 'notifications'}).then(function (notificationPerm) {
    notificationPerm.onchange = function () {
      console.log("User decided to change his seettings. New permission: " + notificationPerm.state);
      if (notificationPerm.state === 'granted') {
        subscribe()
      }
    };
  });
}


async function subscribe() {
  function urlBase64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding)
      .replace(/-/g, '+')
      .replace(/_/g, '/');

    const rawData = window.atob(base64);
    const outputArray = new Uint8Array(rawData.length);

    for (let i = 0; i < rawData.length; ++i) {
      outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
  }

  let sw = await navigator.serviceWorker.ready;
  const vapidPublicKey = 'BPizdVl-Y3_9rlrizw7_NcC7t6QnhwumFmijvUzn4-2j3mELTY0UVqAr7G9MB_cm_DDdKyNozlWlKJTNffrTsk8';
  const convertedVapidKey = urlBase64ToUint8Array(vapidPublicKey);

  let push = await sw.pushManager.subscribe({
    userVisibleOnly: true,
    applicationServerKey: convertedVapidKey
  });

  // jQuery.post("/wp-admin/admin-ajax.php", {action: "add_notification_token", token: JSON.stringify(push)}, function(response){
  //   console.log("Response: " + response);
  // });

  $.ajax({
    type: "POST",
    url: '/wp-admin/admin-ajax.php',
    data: {action: "add_notification_token", token: JSON.stringify(push)},
    dataType: 'json',
  })

}

