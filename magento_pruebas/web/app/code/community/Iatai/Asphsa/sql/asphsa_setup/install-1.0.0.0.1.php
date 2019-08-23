<?php
/**
 * Modulo de integracion de sistema Asph y Secure Acceptance
 *
 * @category   Iatai
 * @package    Iatai_Asphsa
 * @author     Harold Villota
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *
 *
 * @var $installer Iatai_Asphsa_Model_Resource_Setup
 */
 
 
$installer = $this;
$installer->startSetup();
$installer->orderStatusSetup();
$installer->endSetup();
