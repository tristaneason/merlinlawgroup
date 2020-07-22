import {
  onInterframeReady,
  onConnect,
  onDisconnect,
  onMarkAsOutdated,
  onUpgrade,
  onPageReload,
  onInitNavigation,
  onDisableNavigation,
  onClearQueryParam,
  onGetDomain,
  onGetAssetsPayload,
  onEnterFullScreen,
  onExitFullScreen,
} from './api/hubspotPluginApi';
import {
  connect,
  disconnect,
  markAsOutdated,
  getDomain,
  clearPortalIdPolling,
} from './api/wordpressApi';
import { adminUrl, theme } from './constants/leadinConfig';
import { initNavigation, disableNavigation } from './navigation';
import enterFullScreen, { exitFullScreen } from './fullscreen';
import themes from './constants/themes';

onInterframeReady((message, reply) => {
  reply('Interframe Ready');
});

onConnect((portalId, reply) => {
  connect(
    portalId,
    () => {
      clearPortalIdPolling();
      reply({ success: true });
    },
    reply.bind(null, { success: false })
  );
});

onDisconnect((message, reply) => {
  disconnect(
    reply.bind(null, { success: true }),
    reply.bind(null, { success: false })
  );
});

onMarkAsOutdated((message, reply) => {
  markAsOutdated(reply);
});

onUpgrade((message, reply) => {
  reply();
  location.href = `${adminUrl}plugins.php`;
});

onPageReload((message, reply) => {
  reply();
  window.location.reload(true);
});

onInitNavigation((message, reply) => {
  reply();
  initNavigation();
});

onDisableNavigation((message, reply) => {
  reply();
  disableNavigation();
});

onClearQueryParam((message, reply) => {
  reply();
  let currentWindowLocation = window.location.toString();
  if (currentWindowLocation.indexOf('?') > 0) {
    currentWindowLocation = currentWindowLocation.substring(
      0,
      currentWindowLocation.indexOf('?')
    );
  }
  const newWindowLocation = `${currentWindowLocation}?page=leadin`;
  window.history.pushState({}, '', newWindowLocation);
});

onGetDomain((message, reply) => {
  getDomain(data => {
    if (data.domain) {
      reply(data.domain);
    }
  });
});

onGetAssetsPayload((message, reply) => {
  reply({ payload: themes[theme] });
});

onEnterFullScreen((message, reply) => {
  reply();
  enterFullScreen();
});

onExitFullScreen((message, reply) => {
  reply();
  exitFullScreen();
});
