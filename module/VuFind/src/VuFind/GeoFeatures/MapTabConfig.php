<?php
/**
 * Map Tab Configuration Module
 *
 * PHP version 7
 *
 * Copyright (C) Villanova University 2010.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License version 2,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category VuFind
 * @package  GeoFeatures
 * @author   Leila Gonzales <lmg@agiweb.org>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     http://vufind.org/wiki/vufind2:recommendation_modules Wiki
 */
namespace VuFind\GeoFeatures;

/**
 * MapTab Configuration Class
 *
 * @category VuFind
 * @package  GeoFeatures
 * @author   Leila Gonzales <lmg@agiweb.org>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     https://vufind.org/wiki/development:plugins:hierarchy_components Wiki
 */
class MapTabConfig extends AbstractConfig
{
    /**
     * Display Map Tab?
     *
     * @var bool
     */
    protected $recordMap = false;

    /**
     * Should we display coordinates as part of labels?
     *
     * @var bool
     */
    protected $displayCoords = false;

    /**
     * Where should map labels be read from?
     *
     * @var string
     */
    protected $mapLabels = null;

    /**
     * Display graticule / map lat long grid?
     *
     * @var bool
     */
    protected $graticule = false;

    /**
     * Get the map tab configuration settings.
     *
     * @return array
     */
    public function getMapTabOptions()
    {
        $validFields = ['displayCoords', 'mapLabels', 'graticule', 'recordMap'];
        $options = [];
        // Check geofeatures.ini
        $options = $this->getOptions('geofeatures', 'MapTab', $validFields);
        // Check legacy configuration
        if (empty($options)) {
            $options = $this->getOptions('config', 'Content', $validFields);
        }
        if (empty($options)) {
            // use defaults
            foreach ($validFields as $field) {
                $options[$field] = $this->$field;
            }
        }
        return $options;
    }
}
