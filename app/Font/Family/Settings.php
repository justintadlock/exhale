<?php

namespace Exhale\Font\Family;

use Hybrid\Tools\Collection;

class Settings extends Collection {

	public function add( $name, $value ) {

		parent::add( $name, new Setting( $name, $value ) );
	}

	public function customizeToJson() {

		$json = [];

		foreach ( $this->all() as $setting ) {
			$json[] = [
				'modName' => $setting->modName(),
				'property' => sprintf( '--font-family-%s', $setting->name() )
			];
		}

		return $json;
	}
}
