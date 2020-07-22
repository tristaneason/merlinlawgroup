import { domElements } from './constants/selectors';
import { changeRoute } from './api/hubspotPluginApi';

export function initNavigation() {
  function setSelectedMenuItem() {
    jQuery(domElements.subMenuButtons).removeClass('current');
    const pageParam = window.location.search.match(/\?page=leadin_?\w*/)[0]; // filter page query param
    const selectedElement = jQuery(`a[href="admin.php${pageParam}"]`);
    selectedElement.parent().addClass('current');
  }

  function handleNavigation() {
    const appRoute = window.location.search.match(/page=leadin_?(\w*)/)[1];
    changeRoute(appRoute);
    setSelectedMenuItem();
  }

  function handleClick() {
    // Don't interrupt modifier keys
    if (event.metaKey || event.altKey || event.shiftKey) {
      return;
    }
    window.history.pushState(null, null, jQuery(this).attr('href'));
    handleNavigation();
    event.preventDefault();
  }

  // Browser back and forward events navigation
  window.addEventListener('popstate', handleNavigation);

  // Menu Navigation
  jQuery(domElements.allMenuButtons).click(handleClick);
}

export function disableNavigation() {
  jQuery(domElements.allMenuButtons).off('click');
}
