<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Daniel Lienert <daniel@lienert.cc>, Michael Knoll <knoll@punkt.de>
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

// TODO get extbase working in backend mode

/**
 * Class provides dataProvider for FlexForm select lists
 * 
 * @author Daniel Lienert <daniel@lienert.cc>
 * @package Utility
 */

class user_Tx_Yag_Utility_FlexformDataProvider {
	

	/**
	 * Album repository
	 *
	 * @var Tx_Yag_Domain_Repository_AlbumRepository
	 */
	protected $albumRepository;
	
	
	
	/**
	 * Get a list of albums
	 * 
	 * @param array $config
	 * @return array $config
	 */
	public function getAlbumList(array $config) {
		
		$albumList = array();
		if(!is_array($config['items'])) $config['items'] = array();
		
		$this->albumRepository = t3lib_div::makeInstance('Tx_Yag_Domain_Repository_AlbumRepository');
		$albumCollection = $this->albumRepository->findAll();
		
		foreach($albumCollection as $album) {
			$albumList[] = array($album->getUid(), $album->getName());
		}
		
		$config['items'] = array_merge($config['items'], $albumList); 
		
		return $config;
	}
}
?>