<?php
	/**
	 * Copyright 2013, Campai Business Solutions B.V. (http://www.campai.nl)
	 *
	 * Licensed under The MIT License
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright     Copyright 2013, Campai Business Solutions B.V. (http://www.campai.nl)
	 * @link          http://autotask.campai.nl
	 * @license       MIT License (http://opensource.org/licenses/mit-license.php)
	 * @author        Coen Coppens <coen@campai.nl>
	 */
	App::uses('DashboardLicenseAppController', 'DashboardLicense.Controller');

	class LicensesController extends DashboardLicenseAppController {

		public $uses = array();
		private $sLicenseFilePath = 'Plugin/Autotask/Config/license.txt';

		public function edit($iErrorCode = NULL) {

			if ($this->request->is('post') || $this->request->is('put')) {

				try {

					// Save the license to the file.
					$this->writeLicense($this->request->data['License']['license']);
					$this->Session->setFlash('License updated, head on over to your <a href="/">Dashboards</a>!', 'flash_success');

				} catch (Exception $e) {
					$this->Session->setFlash($e->getMessage(), 'flash_error');
				}

			// No form submitted.
			} else {

				$sFlashMessage = '';

				if (!empty($iErrorCode)) {

					switch ($iErrorCode) {

						case 1:
							$sFlashMessage .= 'An encoded file has been corrupted.';
						break;

						case 2:
							$sFlashMessage .= 'An encoded file has reached its expiry time.';
						break;

						case 3:
							$sFlashMessage .= 'An encoded file has a server restriction and is used on a non-authorised system.';
						break;

						case 4:
							$sFlashMessage .= 'An encoded file is used on a system where the clock is set more than 24 hours before the file was encoded.';
						break;

						case 5:
							$sFlashMessage .= 'The license file required by an encoded script could not be found.';
						break;

						case 6:
							$sFlashMessage .= 'The license file has been altered or the passphrase used to decrypt the license was incorrect.';
						break;

						case 7:
							$sFlashMessage .= 'The license file has reached its expiry time.';
						break;

						case 8:
							$sFlashMessage .= 'A property marked as ‘enforced’ in the license file was not matched by a property contained in the encoded file.';
						break;

						case 9:
							$sFlashMessage .= 'Your License is corrupt. Please provide a proper license.';
						break;

						case 10:
							$sFlashMessage .= 'The header block of the license file has been altered.';
						break;

						case 11:
							$sFlashMessage .= 'The license has a server restriction and is used on a non-authorised system.';
						break;

						case 12:
							$sFlashMessage .= 'The encoded file has been included by a file which is either non-encoded or has incorrect properties.';
						break;

						case 13:
							$sFlashMessage .= 'The encoded file has included a file which is either non-encoded or has incorrect properties.';
						break;

						case 14:
							$sFlashMessage .= 'The php.ini has either the --auto-append-file or --auto-prepend-file setting enabled.';
						break;

						default:
						break;
					}

					if (isset($this->request->query['current_file'])) {
						$sFlashMessage .= '<br/><br/>Error triggered by file:<br/><i>' . str_ireplace(ROOT, '', $this->request->query['current_file']) . '</i><br/>';
					}

					$this->Session->setFlash($sFlashMessage, 'flash_error');

				}

				try {
					$this->request->data['License']['license'] = $this->readLicense();
				} catch (Exception $e) {
					$this->Session->setFlash($e->getMessage(), 'flash_error');

				}

			}

		}


		public function missingIoncube() {
		}


		public function readLicense() {

			$sFile = APP . $this->sLicenseFilePath;
			$sContents = '';

			if (!$handle = fopen($sFile, 'r')) {
				throw new Exception('Could not open file "' . $sFile . '"');
			}

			if ($filesize = filesize($sFile)) {

				if (!$sContents = fread($handle, $filesize)) {
					throw new Exception('Could not read file "' . $sFile . '"');
				}

			}

			fclose($handle);

			return $sContents;

		}


		public function writeLicense($sContents) {

			// Write the new license file.
			$sFile = APP . $this->sLicenseFilePath;

			// Let's make sure the file exists and is writable first.
			if (is_writable($sFile)) {

				if (!$handle = fopen($sFile, 'w')) {
					throw new Exception('Could not open file "' . $sFile . '"');
				}

				if (false === fwrite($handle, $sContents) ) {
					throw new Exception('Could not write to file "' . $sFile . '"');
				}

				fclose($handle);

			} else {
				throw new Exception('File "' . $sFile . '" is not writable');
			}

		}

	}