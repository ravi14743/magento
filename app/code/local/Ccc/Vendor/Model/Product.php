<?php 
    class Ccc_Vendor_Model_Product extends Mage_Catalog_Model_Abstract
    {
        const ENTITY = 'vendor_product';
        static protected $_types;
        protected $_typeInstanceSingleton   = null;
        protected $_typeInstance            = null;

        protected function _construct()
        {
            parent::_construct();
            $this->_init('vendor/product');

        }

        protected $_attributes;

        public function getAttributes()
        {

            if ($this->_attributes === null) {
                $this->_attributes = $this->_getResource()
                    ->loadAllAttributes($this)
                    ->getSortedAttributes();
            }
            return $this->_attributes;
        }

        public function checkInGroup($attributeId, $setId, $groupId)
        {
            $resource = Mage::getSingleton('core/resource');

            $readConnection = $resource->getConnection('core_read');
            $readConnection = $resource->getConnection('core_read');

            $query = '
                SELECT * FROM ' .
            $resource->getTableName('eav/entity_attribute')
                . ' WHERE `attribute_id` =' . $attributeId
                . ' AND `attribute_group_id` =' . $groupId
                . ' AND `attribute_set_id` =' . $setId
            ;

            $results = $readConnection->fetchRow($query);

            if ($results) {
                return true;
            }
            return false;
        }

        public function formatUrlKey($str)
        {
            return $this->getUrlModel()->formatUrlKey($str);
        }

        public function getUrlModel()
        {
            if ($this->_urlModel === null) {
                $this->_urlModel = Mage::getSingleton('catalog/factory')->getProductUrlInstance();
            }
            return $this->_urlModel;
        }
    
    }
?>