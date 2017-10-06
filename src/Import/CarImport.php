<?php

namespace Krajcik\Annonce\Import;

use Doctrine\Common\Util\Debug;
use DOMDocument;
use Krajcik\Annonce\Import\Structure\Car;
use Krajcik\Annonce\Import\Structure\CarAdvert;
use Tracy\Debugger;

/**
 * Class CarImport
 * @package Krajcik\Annonce\Import
 */
class CarImport {


	/**
	 * @param string $url
	 * @return CarAdvert
	 */
	public function getCar($url) {
		$dom = new DOMDocument;
		@$dom->loadHTML(file_get_contents($url));
		return $this->createCar($dom);
	}


	/**
	 * @param DOMDocument $dom
	 * @return CarAdvert
	 */
	protected function createCar(DOMDocument $dom) {
		$atrributes = $this->getCarAttributes($dom);
		$price = str_replace('Kč', '', (string) $atrributes['Cena:']);
		$price = str_replace(' ', '', (string) $price);
		$price = preg_replace('/\s+/u', '', $price);
		$price = preg_replace('/\s+/','',$price );
		$state = $atrributes['Nové / ojeté:'] === 'ojeté' ? CarAdvert::TYPE_USED : CarAdvert::TYPE_NEW;
		if (isset($atrributes['Převodovka:'])) {
            $transmission = $atrributes['Převodovka:'];
            $transmission = $transmission === 'manuální' ? CarAdvert::TRANSMISSION_MANUAL : CarAdvert::TRANSMISSION_AUTOMATIC;
        } else {
		    $transmission = NULL;
        }
		$car = new CarAdvert(
			$atrributes['Značka:'],
			$atrributes['Model:'],
			$atrributes['Karoserie:'],
			$atrributes['Rok výroby:'],
			isset($atrributes['Objem motoru:']) ? (int) $atrributes['Objem motoru:'] : NULL,
			isset($atrributes['Výkon:']) ? (int) $atrributes['Výkon:'] : NULL,
			$atrributes['Barva:'],
			$atrributes['Palivo:'],
			(int) $atrributes['Najeto:'],
			$transmission,
			$state,
			(float) $price,
			$atrributes['Kraj:'],
			$atrributes['Okres:'],
			$this->getPhone($dom),
			$this->getDescription($dom),
			$this->getImageLinks($dom),
			$this->getEquipments($dom)
		);
		return $car;
	}



	/**
	 * @param DOMDocument $dom
	 * @return array|string[]
	 */
	protected function getImageLinks(DOMDocument $dom) {
		$imageLinks = [];
		foreach ($dom->getElementsByTagName('ul') as $ul) {
			if ($ul->getAttribute('class') !== 'thumbnails') continue;
			foreach ($ul->getElementsByTagName('a') as $a) {
				$imageLinks[] = 'https://www.annonce.cz' . trim($a->getAttribute('href'));
			}
		}
		return $imageLinks;
	}


	/**
	 * @param DOMDocument $dom
	 * @return array|string[]
	 */
	protected function getEquipments(DOMDocument $dom) {
		$lists = $dom->getElementsByTagName('ul');
		$equipments = [];
		foreach ($lists as $list) {
			if ($list->getAttribute('class') !== 'bullets-two-cols') continue;
			foreach ($list->getElementsByTagName('li') as $li) {
				$equipments[] = (string) $li->nodeValue;
			}
		}
		return $equipments;
	}


	/**
	 * @param DOMDocument $dom
	 * @return null|string
	 */
	protected function getPhone(DOMDocument $dom) {
		$links = $dom->getElementsByTagName('a');
		foreach ($links as $link) {
			if ($link->getAttribute('class') !== 'phone-link') {
				continue;
			}
			return '' . trim($link->nodeValue);
		}
		return NULL;
	}


	/**
	 * @param DOMDocument $dom
	 * @return null|string
	 */
	protected function getDescription(DOMDocument $dom) {
		$elements = $dom->getElementsByTagName('p');
		foreach ($elements as $element) {
			if ($element->getAttribute('class') !== 'ad-desc') continue;
			return trim($element->nodeValue);
		}
		return NULL;
	}

	/**
	 * @param DOMDocument $dom
	 * @return array|string[]
	 */
	protected function getCarAttributes(DOMDocument $dom) {
		$tables = $dom->getElementsByTagName('table');
		$data = [];
		foreach ($tables as $table) {
			/** @var $table \DOMElement */
			$tableClasses = $table->getAttribute('class');
			if (strpos($tableClasses, 'attrs') === FALSE) continue;
			foreach ($table->getElementsByTagName('tr') as $tr) {
				/** @var $tr \DOMElement */
				$name = $tr->getElementsByTagName('th')[0]->nodeValue;
				$value = $tr->getElementsByTagName('td')[0]->nodeValue;
				$data[trim($name)] = trim($value);
			}
		}
		return $data;
	}

}

