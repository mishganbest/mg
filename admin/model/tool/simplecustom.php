<?php
/*
@author	Dmitriy Kubarev
@link	http://www.simpleopencart.com
@link	http://www.opencart.com/index.php?route=extension/extension/info&extension_id=4811
*/  

class ModelToolSimpleCustom extends Model {
    static $types = array(
        'order'    => 1,
        'customer' => 2,
        'address'  => 3
    );
    
    public function loadData($type, $id) {
        $type = !empty(self::$types[$type]) ? self::$types[$type] : 0;

        if (!$type || !$id) {
            return array();
        }

        $query = $this->db->query("SELECT DISTINCT
                                        data
                                    FROM
                                        simple_custom_data
                                    WHERE
                                        object_type = '" . (int)$type . "'
                                    AND
                                        object_id = '" . (int)$id . "'");

		if ($query->num_rows) {
            return unserialize($query->row['data']);
        }

        return array();
    }
}
?>