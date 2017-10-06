<?php

namespace Krajcik\Annonce\Import\Structure;

class CarAdvert {

	const TYPE_NEW = 'new';
	const TYPE_USED = 'used';

	const TRANSMISSION_MANUAL = 'manual';
	const TRANSMISSION_AUTOMATIC = 'automatic';

	/**
	 * @var string
	 */
	protected $vendor;

	/**
	 * @var string
	 */
	protected $model;

	/**
	 * @var string
	 */
	protected $bodywork;

	/**
	 * @var int
	 */
	protected $madeYear;

	/**
	 * @var int
	 */
	protected $volume;

	/**
	 * @var int
	 */
	protected $performance;

	/**
	 * @var string
	 */
	protected $color;

	/**
	 * @var string
	 */
	protected $fuel;

	/**
	 * @var int
	 */
	protected $km;

	/**
	 * @var string
	 */
	protected $transmission;

	/**
	 * @var string
	 */
	protected $carType;

	/**
	 * @var float
	 */
	protected $price;

	/**
	 * @var string
	 */
	protected $region;

	/**
	 * @var string
	 */
	protected $district;

	/**
	 * @var array
	 */
	protected $equipments = [];

	/**
	 * @var array
	 */
	protected $imageLinks = [];

	/**
	 * @var string
	 */
	private $phone;

	/**
	 * @var string
	 */
	private $description;


	/**
	 * Car constructor.
	 * @param string $vendor
	 * @param string $model
	 * @param string $bodywork
	 * @param int    $madeYear
	 * @param null|float    $volume
	 * @param int|null    $performance
	 * @param string $color
	 * @param string $fuel
	 * @param int    $km
	 * @param string $transmission
	 * @param string $carType
	 * @param float  $price
	 * @param string $region
	 * @param string $district
	 * @param string $phone
	 * @param string $description
	 * @param array  $imageLinks
	 * @param array  $equipments
	 */
	public function __construct(
		string $vendor,
		string $model,
		string $bodywork,
		int $madeYear,
		int $volume = NULL,
		int $performance = NULL,
		string $color,
		string $fuel,
		int $km,
		string $transmission,
		string $carType,
		float $price,
		string $region,
		string $district,
		string $phone,
		string $description,
		array $imageLinks,
		array $equipments
	) {
		$this->vendor = $vendor;
		$this->model = $model;
		$this->bodywork = $bodywork;
		$this->madeYear = $madeYear;
		$this->volume = $volume;
		$this->performance = $performance;
		$this->color = $color;
		$this->fuel = $fuel;
		$this->km = $km;
		$this->transmission = $transmission;
		$this->carType = $carType;
		$this->price = $price;
		$this->region = $region;
		$this->district = $district;
		$this->imageLinks = $imageLinks;
		$this->equipments = $equipments;
		$this->phone = $phone;
		$this->description = $description;
	}

	/**
	 * @return string
	 */
	public function getVendor(): string {
		return $this->vendor;
	}

	/**
	 * @return string
	 */
	public function getModel(): string {
		return $this->model;
	}

	/**
	 * @return string
	 */
	public function getBodywork(): string {
		return $this->bodywork;
	}

	/**
	 * @return int
	 */
	public function getMadeYear(): int {
		return $this->madeYear;
	}

	/**
	 * @return int|null
	 */
	public function getVolume() {
		return $this->volume;
	}

	/**
	 * @return int|null
	 */
	public function getPerformance() {
		return $this->performance;
	}

	/**
	 * @return string
	 */
	public function getColor(): string {
		return $this->color;
	}

	/**
	 * @return string
	 */
	public function getFuel(): string {
		return $this->fuel;
	}

	/**
	 * @return int
	 */
	public function getKm(): int {
		return $this->km;
	}

	/**
	 * @return string
	 */
	public function getTransmission(): string {
		return $this->transmission;
	}

	/**
	 * @return string
	 */
	public function getCarType(): string {
		return $this->carType;
	}

	/**
	 * @return float
	 */
	public function getPrice(): float {
		return $this->price;
	}

	/**
	 * @return string
	 */
	public function getRegion(): string {
		return $this->region;
	}

	/**
	 * @return string
	 */
	public function getDistrict(): string {
		return $this->district;
	}


	/**
	 * @return string
	 */
	public function getDescription(): string {
		return $this->description;
	}

	/**
	 * @return string
	 */
	public function getPhone(): string {
		return $this->phone;
	}

	/**
	 * @return array
	 */
	public function getImageLinks(): array {
		return $this->imageLinks;
	}

}
