<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010-2013 Daniel Lienert <typo3@lienert.cc>, Michael Knoll <mimi@kaktusteam.de>
*  All rights reserved
*
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * @package Domain
 * @subpackage ImageProcessing
 * @author Daniel Lienert <typo3@lienert.cc>
 */
class Tx_Yag_Domain_ImageProcessing_ProcessorFactory
{
    /**
     * Holds an instance of the image processor
     *
     * @var Tx_Yag_Domain_ImageProcessing_AbstractProcessor
     */
    protected static $instance = null;


    /**
     * Factory method for file repository
     *
     * @param Tx_Yag_Domain_Configuration_ConfigurationBuilder $configurationBuilder
     * @return null|Tx_Yag_Domain_ImageProcessing_AbstractProcessor
     */
    public static function getInstance(Tx_Yag_Domain_Configuration_ConfigurationBuilder $configurationBuilder)
    {
        if (self::$instance == null) {
            $processorClass = 'Tx_Yag_Domain_ImageProcessing_Typo3Processor';
            $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');

            self::$instance = $objectManager->get($processorClass);
            self::$instance->_injectProcessorConfiguration($configurationBuilder->buildImageProcessorConfiguration());
            self::$instance->_injectHashFileSystem(Tx_Yag_Domain_FileSystem_HashFileSystemFactory::getInstance());
            self::$instance->init();
        }

        return self::$instance;
    }
}
