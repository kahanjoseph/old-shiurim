<?php
    include_once("db.php");

    function addItem($source, $table='shiurim '){
        $arry = array();
        foreach ($source as $key => $value) {
            if ($value !== '' && $value !== null && !ctype_space($value)){
                $arry[$key] = $value;
            }
        }
        $nonAsoc = array_values($arry);
        $deliminator = '';
        global $db;

        try {
            $insert = 'INSERT INTO ' . $table . ' (';
            foreach ($arry as $key => $value) {
                $insert .= $deliminator . $key ;
                $deliminator = ', ';
            }
            $insert .= ') VALUES ( ';
            $deliminator = '';
            foreach ($arry as $irrelevent) {
                $insert .= $deliminator . '?';
                $deliminator = ', ';
            }
            $insert .= ')';

            $statement = $db->prepare($insert);
            $insert = $statement->execute($nonAsoc);
        } catch(PDOException $e) {
		die($e->getMessage());
        }
    }

    //Final value in $arry must be id
    function editItem($arry, $where = 'id', $table='shiurim'){
        $nonAsoc = array_values($arry);
        $trimmed = array_slice($arry, 0, -1);
        try {
            global $db;
            $edit = 'UPDATE ' . $table . ' SET ';
            $deliminator = '';
            foreach ($trimmed as $key => $value) {
                $edit .= $deliminator . $key . ' = ? ';
                $deliminator = ', ';
            }
            $edit .= 'WHERE ' . $where . ' = ?';
            $statement = $db->prepare($edit);
            $statement->execute($nonAsoc);
        } catch(PDOException $e) {
		    die($e->getMessage());
        }
    }

    function getList($table = 'shiurim', $selectors=[], $row = 'level'){
        global $db;
        $string = 'SELECT * FROM ' . $table;
        if(!empty($selectors)){
            $string .= ' WHERE ' . $row . ' ';
            $deliminator = '';
            foreach ($selectors as $category) {
                $string .= $deliminator . ' = ?';
                $deliminator =  ' OR ' . $row;
            }
        }
        $query = $db->prepare($string);
        $result = $query->execute($selectors);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getItem($id, $table = 'shiurim', $where = 'id', $join = ''){
        if(!empty($id)){
            global $db;
            $get = 'SELECT * FROM ' . $table;
            $get .= $join . ' WHERE ' . $where . ' = ?';
            $query = $db->prepare($get);
            $result = $query->execute([$id]);
            $result = $query->fetchAll();
            return $result[0];
        }
    }

    function deleteItem($id, $table = 'shiurim'){
        global $db;
        $delete = 'DELETE FROM ' .$table . ' WHERE id = ?';
        $statement = $db->prepare($delete);
        $delete = $statement->execute([$id]);
    }
?>