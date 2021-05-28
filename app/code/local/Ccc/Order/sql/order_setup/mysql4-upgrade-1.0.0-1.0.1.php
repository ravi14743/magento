<?php
$installer = $this;
$installer->startSetup();
//order grid table
$table = $installer->getConnection()
    ->newTable($installer->getTable('order/quote'))
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Entity Id')
    ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        ), 'Customer Id')
        ->addColumn('shipping_name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Shipping Name')
        ->addColumn('billing_name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Billing Name')
        ->addColumn('shipping_method', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Shipping Method')
        ->addColumn('payment_method', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Payment Method')
        ->addColumn('shipping_amount', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Shipping Amount')
        ->addColumn('base_grand_total', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
            ), 'Base Grand Total')
        ->addColumn('discount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
            ), 'Discount')
        ->addColumn('grand_total', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
            ), 'Grand Total')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        ), 'Created At')
    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        ), 'Updated At')
    ->addIndex($installer->getIdxName('order/quote', array('base_grand_total')),
        array('base_grand_total'))
    ->addIndex($installer->getIdxName('order/quote', array('grand_total')),
        array('grand_total'))
    ->addIndex($installer->getIdxName('order/quote', array('discount')),
        array('discount'))
    ->addIndex($installer->getIdxName('order/quote', array('shipping_name')),
        array('shipping_name'))
    ->addIndex($installer->getIdxName('order/quote', array('billing_name')),
        array('billing_name'))
    ->addIndex($installer->getIdxName('order/quote', array('created_at')),
        array('created_at'))
    ->addIndex($installer->getIdxName('order/quote', array('customer_id')),
        array('customer_id'))
    ->addIndex($installer->getIdxName('order/quote', array('updated_at')),
        array('updated_at'))
    ->addForeignKey($installer->getFkName('order/quote', 'customer_id', 'customer/entity', 'entity_id'),
        'customer_id', $installer->getTable('customer/entity'), 'entity_id',
        Varien_Db_Ddl_Table::ACTION_SET_NULL, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('Quote table');
$installer->getConnection()->createTable($table);

$table = $installer->getConnection()
    ->newTable($installer->getTable('order/quote_address'))
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Entity Id')
    ->addColumn('customer_address_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        ), 'Customer Address Id')
    ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        ), 'Customer Id')
    ->addColumn('quote_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        ), 'Quote Id')
    ->addColumn('fax', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Fax')
    ->addColumn('region', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Region')
    ->addColumn('postcode', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Postcode')
    ->addColumn('lastname', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Lastname')
    ->addColumn('street', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Street')
    ->addColumn('city', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'City')
    ->addColumn('email', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Email')
    ->addColumn('telephone', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Telephone')
    ->addColumn('country_id', Varien_Db_Ddl_Table::TYPE_TEXT, 2, array(
        ), 'Country Id')
    ->addColumn('firstname', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Firstname')
    ->addColumn('address_type', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Address Type')
    ->addColumn('prefix', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Prefix')
    ->addColumn('middlename', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Middlename')
    ->addColumn('suffix', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Suffix')
    ->addColumn('company', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Company')
    ->addForeignKey($installer->getFkName('order/quote_address', 'quote_id', 'order/quote', 'entity_id'),
        'quote_id', $installer->getTable('order/quote'), 'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('Order Address');
$installer->getConnection()->createTable($table);

$table = $installer->getConnection()
    ->newTable($installer->getTable('order/quote_item'))
    ->addColumn('item_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Item Id')
    ->addColumn('quote_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '0',
        ), 'Quote Id')
    ->addColumn('product_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        ), 'Product Id')
    ->addColumn('sku', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Sku')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Name')
    ->addColumn('description', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(
        ), 'Description')
    ->addColumn('price', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
        ), 'Price')
    ->addColumn('quantity', Varien_Db_Ddl_Table::TYPE_INTEGER,null, array(
        'nullable'  => false,
        ), 'Quantity')
    ->addColumn('discount_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'default'   => '0.0000',
        ), 'Discount Amount')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'nullable'  => false,
        ), 'Created At')
    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'nullable'  => false,
        ), 'Updated At')
    ->addForeignKey($installer->getFkName('order/quote_item', 'quote_id', 'order/quote', 'entity_id'),
        'quote_id', $installer->getTable('order/quote'), 'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('Quote Item');
$installer->getConnection()->createTable($table);


$installer->endSetup();