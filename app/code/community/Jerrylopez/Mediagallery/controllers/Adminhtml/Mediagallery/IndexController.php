<?php
require_once('Mage/Adminhtml/controllers/Cms/Wysiwyg/ImagesController.php');
class Jerrylopez_Mediagallery_Adminhtml_Mediagallery_IndexController extends Mage_Adminhtml_Cms_Wysiwyg_ImagesController
{
	public function indexAction()
	{
		$storeId = (int) $this->getRequest()->getParam('store');

		try {
			Mage::helper('cms/wysiwyg_images')->getCurrentPath();
		} catch (Exception $e) {
			$this->_getSession()->addError($e->getMessage());
		}

		$this->_title($this->__('Media Gallery'));
		$this->_initAction()->loadLayout();
		$block = $this->getLayout()->getBlock('wysiwyg_images.js');
		if ($block) {
			$block->setStoreId($storeId);
		}
		$this->renderLayout();
	}

	public function contentsAction()
	{
		try {
			$this->_initAction()->_saveSessionCurrentPath();
			$this->loadLayout('empty');
			$this->renderLayout();
		} catch (Exception $e) {
			$result = array('error' => true, 'message' => $e->getMessage());
			$this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
		}
	}
}