<?php

namespace App\Models;

class AbstractModel
{
    /**
     * Load data into model from assoc array
     * @param $data
     * @return $this
     */
    public function load($data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
        return $this;
    }

}
