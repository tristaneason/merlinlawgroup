<?php

class SGPMBase
{
	/**
	 * Holds the class object.
	 *
	 * @since 1.0.0
	 *
	 * @var object
	 */
	public static $instance;

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $version = SGPM_VERSION;

	/**
	 * The name of the plugin.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $pluginName = 'Popup Maker WP';

	/**
	 * Unique plugin slug identifier.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $pluginSlug = 'sgpmpopupmaker';

	/**
	 * Notification engine object.
	 *
	 * @since 1.2.3.0
	 *
	 * @var string
	 */
	public $notificationEngine = null;

	/**
	 * Loads the plugin into WordPress.
	 *
	 * @since 1.0.0
	 */
	public function init()
	{
		// Autoload the class files.
		spl_autoload_register('SGPMBase::autoload');
		register_activation_hook(SGPM_PATH.'popup-maker-api.php', array('SGPMBase', 'activate'));
		register_uninstall_hook(SGPM_PATH.'popup-maker-api.php', array('SGPMBase', 'deactivate'));
		// update data of old user
		add_action('plugins_loaded', array($this, 'overallInit'));
		/**
		 * remove comments for testing
		 *
		 * add_action('plugins_loaded', array($this, 'fetchNewNotifications'));
		 */

		$this->helper = new SGPMHelper();
		$this->menu = new SGPMMenu();
		$this->api = new SGPMApi();
		$this->output = new SGPMOutput();
		add_action('init', array($this, 'registerDataConfig'), 99999);

		add_action('init', array($this, 'registerNotificationEngine'), 99999);
		add_action('admin_notices', array($this, 'showNotificationsShade'));
		add_action('admin_enqueue_scripts', array($this, 'adminStyles'));

		add_action('wp_ajax_sgpm_remove_all_notification', array($this, 'removeAllNotifications'));
		add_action('wp_ajax_sgpm_remove_notification', array($this, 'removeNotification'));
	}

	public function adminStyles()
	{
		wp_register_style($this->pluginSlug.'-admin', SGPM_ASSETS_URL.'css/admin.css', array(), $this->version);
		wp_enqueue_style($this->pluginSlug.'-admin');
		wp_register_style($this->pluginSlug.'-notification-shade', SGPM_ASSETS_URL.'css/notification-shade.css', array(), $this->version);
		wp_enqueue_style($this->pluginSlug.'-notification-shade');
	}

	public function showNotificationsShade()
	{
		$isPluginScreen = false;

		if (function_exists('get_current_screen')) {
			$screen = get_current_screen();
			$isPluginScreen = strpos($screen->id, 'popup-maker-api-settings');
		}

		$this->notificationEngine->setNotificationBadgeData();

		if ($isPluginScreen) {
			$this->notificationEngine->create();
		}
	}

	public function removeAllNotifications()
	{
		$this->notificationEngine->removeAllNotifications();
	}

	public function removeNotification()
	{
		$notificationType = $_POST['notificationType'];

		if ($notificationType == 'review') {
			add_option('sgpm_popup_maker_dismiss_review_notice', 'true');
			return;
		}

		$hash = $_POST['hash'];
		$notificationId = $_POST['notificationId'];
		$this->notificationEngine->removeNotification($hash, $notificationId);
	}

	public function registerDataConfig()
	{
		if (file_exists(SGPM_CLASSES.'SGPMDataConfig.php')) {
			require_once(SGPM_CLASSES.'SGPMDataConfig.php');
			SGPMDataConfig::init();
		}
	}

	public function registerNotificationEngine()
	{
		$storedNotificationSource = get_option('sgpm_popup_maker_notification_engine_source');
		if (!$storedNotificationSource) {
			$responce = wp_remote_get(SGPM_NOTIFICATIONS_API_URL);
			$body = wp_remote_retrieve_body($responce);

			if (is_wp_error($responce)) {
				wp_die("Something went wrong after fetching notifiactions!");
				return;
			}

			$notificationsSource = json_decode($body, true);
			$validBody = self::validateNotificationsBody($notificationsSource);

			if (!isset($notificationsSource) || !$validBody) {
				$notificationsSource = array();
			}

			add_option('sgpm_popup_maker_notification_engine_source', maybe_serialize($notificationsSource));
			add_option('sgpm_popup_maker_dismissed_notifacions', json_encode(array()));
		}

		if (file_exists(SGPM_CLASSES.'SGPMNotificationEngine.php')) {
			require_once(SGPM_CLASSES.'SGPMNotificationEngine.php');
			$this->notificationEngine = SGPMNotificationEngine::getInstance();
		}
	}

	public static function validateNotificationsBody($body)
	{
		if (isset($body[0])) {
			$notifications = $body[0];

			return isset($notifications['title']);
		}
	}

	public function overallInit()
	{
		$options = get_option('sgpm_popup_maker_api_option');
		if (empty($options)) {
			$options = array();
		}
		if (isset($options['pluginVersion']) && $options['pluginVersion'] >= '1.13') return;

		$options['pluginVersion'] = SGPM_VERSION;
	 	if (!isset($options['popups'])) return;

	 	foreach ($options['popups'] as $popupId => $popup) {
	  		if (!isset($options['popupsSettings'][$popupId])) continue;
	  		$popupSettings = $options['popupsSettings'][$popupId];

			if (!isset($popupSettings['displayTarget'])) {
				$popupSettings['displayTarget'] = $this->getUpdatedSettingsForOldUser($popupSettings);
				$options['popupsSettings'][$popupId] = $popupSettings;
			}
	 	}

		update_option('sgpm_popup_maker_api_option', $options);
	}

	public function getUpdatedSettingsForOldUser($popupSettings)
	{
		$updatedSettings = array();

		if (isset($popupSettings['showOnAllPosts']) && $popupSettings['showOnAllPosts'] == 'on') {
			$updatedSettings[] = array(
				'param' => 'post_all',
				'operator' => '=='
			);
		}
		if (isset($popupSettings['showOnSomePosts']) && $popupSettings['showOnSomePosts'] == 'on') {
			$updatedSettings[] = array(
				'param' => 'post_selected',
				'operator' => '==',
				'value' => $this->getSelectedPostAssocArray($popupSettings['selectedPosts'])
			);
		}
		if (isset($popupSettings['showOnAllPages']) && $popupSettings['showOnAllPages'] == 'on') {
			$updatedSettings[] = array(
				'param' => 'page_all',
				'operator' => '=='
			);
			$updatedSettings[] = array(
				'param' => 'page_type',
				'operator' => '==',
				'value' => array('is_home_page')
			);
		}
		if (isset($popupSettings['showOnSomePages']) && $popupSettings['showOnSomePages'] == 'on') {
			$updatedSettings[] = array(
				'param' => 'page_selected',
				'operator' => '==',
				'value' => $this->getSelectedPostAssocArray($popupSettings['selectedPages'])
			);

			if (in_array('-1', $popupSettings['selectedPages'])) {
				$updatedSettings[] = array(
					'param' => 'page_type',
					'operator' => '==',
					'value' => array('is_home_page')
				);
			}

		}
		return $updatedSettings;
	}

	public function getSelectedPostAssocArray($selectedPost)
	{
		$newSelectedPost = array();
		foreach ($selectedPost as $key => $selectedPostId) {
			if ($selectedPostId == '-1') continue;
			$newSelectedPost[$selectedPostId] = get_the_title($selectedPostId);
		}
		return $newSelectedPost;
	}

	public static function autoload($classname)
	{
		// Return early if not the proper classname.
		if ('SGPM' !== substr($classname, 0, 4)) {
			return;
		}
		// Check if the file exists. If so, load the file.
		$filename = SGPM_CLASSES.$classname.'.php';
		if (file_exists($filename)) {
			require_once($filename);
		}
	}

	public static function activate()
	{
		$activationDate = get_option('sgpm_popup_maker_activation_date');
   		if (!$activationDate) {
   			add_option('sgpm_popup_maker_activation_date', strtotime("now"));
   		}
	}

	public static function deactivate()
	{
		delete_option('sgpm_popup_maker_api_option');
		delete_option('sgpm_popup_maker_activation_date');
		delete_option('sgpm_popup_maker_dismiss_review_notice');
		delete_option('sgpm_popup_maker_notification_engine_source');
		delete_option('sgpm_popup_maker_dismissed_notifacions');
	}

	/**
	 * Returns the singleton instance of the class.
	 *
	 * @since 1.0.0
	 *
	 * @return SGPMBase
	 */
	public static function getInstance()
	{
		if (!isset( self::$instance ) && !(self::$instance instanceof SGPMBase)) {
			self::$instance = new SGPMBase();
		}

		return self::$instance;
	}
}
