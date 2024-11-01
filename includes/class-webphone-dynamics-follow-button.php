<?php

/**
 * Load Webphone Follow Button
 *
 * @link       https://webphone.net
 * @since      1.0.0
 *
 * @package    Webphone_Dynamics
 * @subpackage Webphone_Dynamics/includes
 */

/**
 * Register data field Webphone follo button options
 *
 *
 * @package    Webphone_Dynamics
 * @subpackage Webphone_Dynamics/includes
 * @author     Webphone <webphone@ipglobal.es>
 */
class WPHD_Webphone_Dynamics_Follow_Button {

  /**
   * Object widget ID
   * @var integer|string
   */
  private $objectIdWph;

  /**
   * Position follow button
   * @var string|void
   */
  private $objectPosWph;

  /**
   * @var string|void
   */
  private $gPhoneTitle;

	/**
	 * webphone_settings get_option
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

    if (get_option('objectidwph')) {
      $this->objectIdWph = get_option('objectidwph');
    }
    if (get_option('objectposwph')) {
      $this->objectPosWph = get_option('objectposwph');
    }
    if (get_option('gphone_title')) {
      $this->gPhoneTitle = get_option('gphone_title');
    }

	}

  /**
   * @return int|string
   */
  public function getObjectIdWph() {
    return $this->objectIdWph;
  }

  /**
   * @return string|void
   */
  public function getObjectPosWph() {
    return $this->objectPosWph;
  }

  /**
   * @return string|void
   */
  public function getGPhoneTitle() {
    return $this->gPhoneTitle;
  }



}
