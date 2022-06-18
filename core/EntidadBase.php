<?php

class EntidadBase
{
    private $table;
    private $db;
    private $conectar;

    public function __construct($table, $adapter)
    {
        $this->table = (string)$table;
        $this->conectar = null;
        $this->db = $adapter;

    }

    public function getConetar()
    {
        return $this->conectar;
    }

    public function db()
    {
        return $this->db;
    }

    public function getAll()
    {
        $query = $this->db->prepare("SELECT * FROM $this->table ORDER BY id DESC");
        $query->execute();
        //Devolvemos el resultset en forma de array de objetos
        while ($row = $query->fetch(PDO::FETCH_OBJ)) {
            $resultSet[] = $row;
        }

        return $resultSet;
    }

    public function getAllBy($column, $value)
    {
        $query = $this->db->prepare("SELECT * FROM $this->table WHERE $column='$value' ORDER BY id DESC");
        $query->execute();
        //Devolvemos el resultset en forma de array de objetos
        while ($row = $query->fetch(PDO::FETCH_OBJ)) {
            $resultSet[] = $row;
        }

        return $resultSet;
    }

    public function getById($id)
    {
        $query = $this->db->prepare("SELECT * FROM $this->table WHERE id=$id");
        $query->execute();
        if ($query == true) {
            if ($query->rowCount() == 1) {
                if ($row = $query->fetch(PDO::FETCH_OBJ)) {
                    $resultSet = $row;
                }
            } else {
                $resultSet = null;
            }
        } else {
            $resultSet = false;
        }

        return $resultSet;
    }

    public function getBy($column, $value)
    {
        $query = $this->db->prepare("SELECT * FROM $this->table WHERE $column='$value'");
        $query->execute();
        if ($query == true) {
            if ($query->rowCount() > 1) {
                while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                    $resultSet[] = $row;
                }
            } elseif ($query->rowCount() == 1) {
                if ($row = $query->fetch(PDO::FETCH_OBJ)) {
                    $resultSet = $row;
                }
            } else {
                $resultSet = null;
            }
        } else {
            $resultSet = false;
        }

        return $resultSet;
    }

    public function getByTwoParameters($column, $value, $column2, $value2)
    {
        $query = $this->db->prepare("SELECT * FROM $this->table WHERE $column='$value' AND $column2='$value2'");
        $query->execute();
        if ($query == true) {
            if ($query->rowCount() > 1) {
                while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                    $resultSet[] = $row;
                }
            } elseif ($query->rowCount() == 1) {
                if ($row = $query->fetch(PDO::FETCH_OBJ)) {
                    $resultSet = $row;
                }
            } else {
                $resultSet = null;
            }
        } else {
            $resultSet = false;
        }

        return $resultSet;
    }

    public function getByThreeParameters($column, $value, $column2, $value2, $column3, $value3)
    {
        $query = $this->db->prepare("SELECT * FROM $this->table WHERE $column='$value' AND $column2='$value2' AND $column3='$value3'");
        $query->execute();
        if ($query == true) {
            if ($query->rowCount() > 1) {
                while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                    $resultSet[] = $row;
                }
            } elseif ($query->rowCount() == 1) {
                if ($row = $query->fetch(PDO::FETCH_OBJ)) {
                    $resultSet = $row;
                }
            } else {
                $resultSet = null;
            }
        } else {
            $resultSet = false;
        }

        return $resultSet;
    }

    public function deleteById($id)
    {
        $query = $this->db->prepare("DELETE FROM $this->table WHERE id=$id");
        $query->execute();
        return $query;
    }

    public function deleteBy($column, $value)
    {
        $query = $this->db->prepare("DELETE FROM $this->table WHERE $column='$value'");
        $query->execute();
        return $query;
    }

    public function deleteByColumsConfig($column, $value, $column2, $value2, $column3, $value3)
    {
        $query = $this->db->prepare("DELETE FROM $this->table WHERE $column='$value' AND $column2='$value2' AND $column3='$value3'");
        if ($query->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    public function updateById($columnEdit, $valueEdit, $columnRef, $valueRef)
    {
        $query = $this->db->prepare("UPDATE $this->table SET $columnEdit='$valueEdit' WHERE $columnRef=$valueRef");
        if ($query->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    public function updateBy($columnEdit, $valueEdit, $columnRef, $valueRef)
    {
        $query = $this->db->prepare("UPDATE $this->table SET $columnEdit='$valueEdit' WHERE $columnRef='$valueRef'");
        if ($query->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }
    public function updateByQuery($queryBuild)
    {
        $query = $this->db->prepare($queryBuild);
        if ($query->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }
    public function selectByQuery($queryBuild)
    {
        $query = $this->db->prepare($queryBuild);
        $query->execute();
        if ($query == true) {
            if ($query->rowCount() > 1) {
                while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                    $resultSet[] = $row;
                }
            } elseif ($query->rowCount() == 1) {
                if ($row = $query->fetch(PDO::FETCH_OBJ)) {
                    $resultSet = $row;
                }
            } else {
                $resultSet = null;
            }
        } else {
            $resultSet = false;
        }
        return $resultSet;
    }


    /*-----------------------------------------------------------
    CREAMOS UN METODO GENERAL PARA DATATABLES
    -----------------------------------------------------------*/
    public function method_datatables($column = null, $valor = null, $column1 = null, $valor1 = null, $column2 = null, $valor2 = null)
    {
        /*-----------------------------------------------------------
        OBTENGO LOS NOMBRES DE LAS COLUMNAS DE LA DB
        -----------------------------------------------------------*/
        $query = $this->db->prepare("DESCRIBE $this->table");
        $query->execute();
        /*-----------------------------------------------------------
        DEVOLVEMOS SOLO EL NOMBRE DE LAS COLUMNAS
        -----------------------------------------------------------*/
        $table_fields = $query->fetchAll(PDO::FETCH_COLUMN);
        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = $_POST['search']['value']; // Search value

        $searchArray = array();
        ## Search
        $searchQuery = " ";
        if ($searchValue != '') {
            //Leo cuantos elementos hay en el array
            $cont = count($table_fields);
            //Consulto las keys del array
            $keys = array_keys($table_fields);
            //Busco la ultima
            $ultima_key = $keys[$cont - 1];
            $searchQuery = ' AND (';
            foreach ($table_fields as $key => $value) {
                if ($key == $ultima_key) {
                    $searchQuery .= '' . $value . ' LIKE :' . $value . '';
                } else {
                    $searchQuery .= '' . $value . ' LIKE :' . $value . ' OR ';
                }
            }
            $searchQuery .= ')';

            foreach ($table_fields as $key => $value) {
                $searchArray["$value"] = "%$searchValue%";
            }
        }
        /*-----------------------------------------------------------
        VERIFICO SI VIENEN PARAMETROS A PARTIR DE LA COLUM1
        -----------------------------------------------------------*/
        if ($column != null && $column1 != null && $column2 != null) {
            $queryAdd = "AND $column = '$valor' AND $column1 = '$valor1' AND $column2 = '$valor2'";
        } elseif ($column != null && $column1 != null) {
            $queryAdd = "AND $column = '$valor' AND $column1 = '$valor1'";
        } elseif ($column2 != null) {
            $queryAdd = "AND $column2 = '$valor2'";
        } elseif ($column1 != null) {
            $queryAdd = "AND $column1 = '$valor1'";
        } elseif ($column != null) {
            $queryAdd = "AND $column = '$valor'";
        } else {
            $queryAdd = "";
        }
        ## Total number of records without filtering
        $query = "SELECT COUNT(*) AS allcount FROM $this->table WHERE 1 $queryAdd";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $records = $stmt->fetch();
        $totalRecords = $records['allcount'];

        ## Total number of records with filtering
        $query = "SELECT COUNT(*) AS allcount FROM $this->table WHERE 1 " . $searchQuery . " $queryAdd";
        $stmt = $this->db->prepare($query);
        $stmt->execute($searchArray);
        $records = $stmt->fetch();
        $totalRecordwithFilter = $records['allcount'];

        ## Fetch records
        $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE 1 " . $searchQuery . " $queryAdd ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");
        // Bind values
        foreach ($searchArray as $key => $search) {
            $stmt->bindParam(':' . $key, $search, PDO::PARAM_STR);
        }
        $stmt->bindParam(':limit', $row, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $rowperpage, PDO::PARAM_INT);
        $stmt->execute();
        $empRecords = $stmt->fetchAll();
        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "data" => $empRecords
        );

        return ($response);
    }
    /*
     * Aquí podemos montarnos un montón de métodos que nos ayuden
     * a hacer operaciones con la base de datos de la entidad
     */

    /*-----------------------------------------------------------
    CREAMOS UN METODO GENERAL PARA INSERTAR DATOS
    -----------------------------------------------------------*/
    public function postData($data)
    {
        $columns = "(";
        $params = "(";

        foreach ($data as $key => $value) {
            $columns .= $key . ",";
            $params .= ":" . $key . ",";
        }
        $columns = substr($columns, 0, -1);
        $params = substr($params, 0, -1);

        $columns = ")";
        $params = ")";

        $query = $this->db->prepare("INSERT INTO $this->table $columns VALUES $params");
        foreach ($data as $key => $value) {
            $query->bindParam(":" . $key, $data[$key], PDO::PARAM_STR);
        }

        if ($query->execute()) {
            return "ok";
        } else {
            return "error";
        }

    }
    /*-----------------------------------------------------------
    CREAMOS UN METODO GENERAL PARA INSERTAR DATOS
    -----------------------------------------------------------*/
    public function deleteData($table,$column,$value)
    {
        $query = $this->db->prepare("DELETE FROM $table WHERE $column='$value'");
        $query->execute();
        if ($query->execute()) {
            return "ok";
        } else {
            return "error";
        }

    }

    public function ejecutarSql($query)
    {
        $query = $this->db()->prepare($query);
        $query->execute();
        if ($query == true) {
            if ($query->rowCount() > 1) {
                while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                    $resultSet[] = $row;
                }
            } elseif ($query->rowCount() == 1) {
                if ($row = $query->fetch(PDO::FETCH_OBJ)) {
                    $resultSet = $row;
                }
            } else {
                $resultSet = true;
            }
        } else {
            $resultSet = false;
        }

        return $resultSet;
    }

    /*-----------------------------------------------------------
    CREAMOS UN METODO GENERAL PARA UPDATE DATOS
    -----------------------------------------------------------*/
    public function postDataGeneral($table, $data)
    {
        $db = $this->db();
        $columns = "(";
        $params = "(";
        foreach ($data as $key => $value) {
            $columns .= $key . ",";
            $params .= ":" . $key . ",";
        }
        $columns = substr($columns, 0, -1);
        $params = substr($params, 0, -1);


        $columns .= ")";
        $params .= ")";

        $query = $db->prepare("INSERT INTO $table $columns VALUES $params");
        //var_dump($query);
        foreach ($data as $key => $value) {
            $query->bindParam(":" . $key, $data[$key], PDO::PARAM_STR);
        }


        if ($query->execute()) {
            $_SESSION["las_id"] = $db->lastInsertId();
            return "ok";
        } else {
            return "error";
        }

    }

    /*-----------------------------------------------------------
    CREAMOS UN METODO GENERAL PARA ACTUALIZAR DATOS
    -----------------------------------------------------------*/
    public function putData($table, $data, $id, $nameId)
    {
        $set = "";
        foreach ($data as $key => $value) {
            $set .= $key . "=:" . $key . ",";
        }

        $set = substr($set, 0, -1);

        $query = $this->db()->prepare("UPDATE $table SET $set WHERE $nameId = :$nameId");
        foreach ($data as $key => $value) {
            $query->bindParam(":" . $key, $data[$key], PDO::PARAM_STR);
        }
        $query->bindParam(":" . $nameId, $id, PDO::PARAM_INT);

        if ($query->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    public function putDataGeneral($table, $data, $id, $nameId)
    {
        $db = $this->db();
        $set = "";
        foreach ($data as $key => $value) {
            $set .= $key . "=:" . $key . ",";
        }

        $set = substr($set, 0, -1);

        $query = $db->prepare("UPDATE $table SET $set WHERE $nameId = :$nameId");
        foreach ($data as $key => $value) {
            $query->bindParam(":" . $key, $data[$key], PDO::PARAM_STR);
        }
        $query->bindParam(":" . $nameId, $id, PDO::PARAM_INT);

        if ($query->execute()) {
            $_SESSION["las_id_anterior"] = $id;
            $_SESSION["las_id"] = $db->lastInsertId();
            return "ok";
        } else {
            return "error";
        }
    }

    /*-----------------------------------------------------------
    CREAMOS UN METODO GENERAL PARA DATATABLES
    -----------------------------------------------------------*/
    public function datatablesFetchAll($filtro=null, $params = null, $paramsLeft = null, $whereC = null)
    {
        /*-----------------------------------------------------------
        OBTENGO LOS NOMBRES DE LAS COLUMNAS DE LA DB
        -----------------------------------------------------------*/
        $query = $this->db()->prepare("DESCRIBE $this->table");
        $query->execute();
        /*-----------------------------------------------------------
        DEVOLVEMOS SOLO EL NOMBRE DE LAS COLUMNAS
        -----------------------------------------------------------*/
        $table_fields = $query->fetchAll(PDO::FETCH_COLUMN);

        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = trim($_POST['search']['value']); // Search value

        $searchArray = array();
        ## Search
        $searchQuery = "";
        if ($searchValue != '') {
            $con = 1;
            //Leo cuantos elementos hay en el array
            $cont = count($table_fields);
            //Consulto las keys del array
            $keys = array_keys($table_fields);
            //Busco la ultima
            if (is_null($filtro)){
                $ultima_key = $keys[$cont - 1];
                $recorrerParams = $table_fields;
            }else{
                $ultima_key = count($filtro) - 1;
                $recorrerParams = $filtro;
            }
            $myfilter = array();
            $searchQuery = '(';
            foreach ($recorrerParams as $key => $value) {
                $va = "param_" . $con;
                if ($key == $ultima_key) {
                    $searchQuery .= '' .  $value . ' LIKE :' . $va . '';
                } else {
                    $searchQuery .= '' .  $value . ' LIKE :' . $va . ' OR ';
                }
                $clea = trim($searchValue);
                $searchArray["$va"] = "%$clea%";
                $con++;
            }
            $searchQuery .= ')';
        }


        if ($params == null) {
            $paramsSelect = "*";
        } else {
            $paramsSelect = $params;
        }

        if ($paramsLeft == null) {
            $paramsSelectLeft = "";
        } else {
            $paramsSelectLeft = $paramsLeft;
        }

        if ($whereC == null) {
            $paramsSelectWhere = "1";
        } else {
            $paramsSelectWhere = $whereC;
        }


        if ($searchValue != '') {
            ## Total number of records without filtering
            $query1 = "SELECT COUNT(*) AS allcount FROM $this->table WHERE $paramsSelectWhere";
            ## Total number of records with filtering
            $query2 = "SELECT COUNT(*) AS allcount FROM $this->table $paramsSelectLeft WHERE $searchQuery AND $paramsSelectWhere";
            ## Fetch records
            $query3 = $this->db->prepare("SELECT $paramsSelect FROM $this->table $paramsSelectLeft WHERE $searchQuery AND $paramsSelectWhere ORDER BY " . $this->table.".".$columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

        } else {
            ## Total number of records without filtering
            $query1 = "SELECT COUNT(*) AS allcount FROM $this->table WHERE $paramsSelectWhere";
            ## Total number of records with filtering
            $query2 = "SELECT COUNT(*) AS allcount FROM $this->table $paramsSelectLeft WHERE $paramsSelectWhere";
            ## Fetch records
            $query3 = $this->db->prepare("SELECT $paramsSelect FROM $this->table $paramsSelectLeft WHERE $paramsSelectWhere ORDER BY " . $this->table.".".$columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");
        }

        // var_dump($query1);
        // var_dump($query2);
        // var_dump($query3);
        // var_dump($searchArray);

        ## Total number of records without filtering
        $stmt1 = $this->db->prepare($query1);
        $stmt1->execute();
        $records1 = $stmt1->fetch();
        $totalRecords = $records1['allcount'];
        ## Total number of records with filtering
        $stmt2 = $this->db->prepare($query2);
        foreach ($searchArray as $key => $search) {
            $stmt2->bindParam(':' . $key, $search, PDO::PARAM_STR);
        }
        $stmt2->execute();
        $records2 = $stmt2->fetch();
        $totalRecordwithFilter = $records2['allcount'];
        // Bind values
        foreach ($searchArray as $key => $search) {
            $query3->bindParam(':' . $key, $search, PDO::PARAM_STR);
        }
        $query3->bindParam(':limit', $row, PDO::PARAM_INT);
        $query3->bindParam(':offset', $rowperpage, PDO::PARAM_INT);
        $query3->execute();
        $empRecords = $query3->fetchAll();


        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "data" => $empRecords
        );

        return ($response);
    }

    /*-----------------------------------------------------------
    CREAMOS UN METODO GENERAL PARA DATATABLES DINAMICO
    -----------------------------------------------------------*/
    public function datatablesFetchAllDinamic($table=null, $filtro=null, $params = null, $paramsLeft = null, $whereC = null)
    {
        /*-----------------------------------------------------------
        OBTENGO LOS NOMBRES DE LAS COLUMNAS DE LA DB
        -----------------------------------------------------------*/
        $query = $this->db()->prepare("DESCRIBE $table");
        $query->execute();
        /*-----------------------------------------------------------
        DEVOLVEMOS SOLO EL NOMBRE DE LAS COLUMNAS
        -----------------------------------------------------------*/
        $table_fields = $query->fetchAll(PDO::FETCH_COLUMN);

        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = trim($_POST['search']['value']); // Search value

        $searchArray = array();
        ## Search
        $searchQuery = "";
        if ($searchValue != '') {
            $con = 1;
            //Leo cuantos elementos hay en el array
            $cont = count($table_fields);
            //Consulto las keys del array
            $keys = array_keys($table_fields);
            //Busco la ultima
            if (is_null($filtro)){
                $ultima_key = $keys[$cont - 1];
                $recorrerParams = $table_fields;
            }else{
                $ultima_key = count($filtro) - 1;
                $recorrerParams = $filtro;
            }
            $myfilter = array();
            $searchQuery = '(';
            foreach ($recorrerParams as $key => $value) {
                $va = "param_" . $con;
                if ($key == $ultima_key) {
                    $searchQuery .= '' .  $value . ' LIKE :' . $va . '';
                } else {
                    $searchQuery .= '' .  $value . ' LIKE :' . $va . ' OR ';
                }
                $clea = trim($searchValue);
                $searchArray["$va"] = "%$clea%";
                $con++;
            }
            $searchQuery .= ')';
        }


        if ($params == null) {
            $paramsSelect = "*";
        } else {
            $paramsSelect = $params;
        }

        if ($paramsLeft == null) {
            $paramsSelectLeft = "";
        } else {
            $paramsSelectLeft = $paramsLeft;
        }

        if ($whereC == null) {
            $paramsSelectWhere = "1";
        } else {
            $paramsSelectWhere = $whereC;
        }

        if(strpos($columnName,"#") !== false){
            $orderBy = str_replace("#",".",$columnName);
        }else{
            $orderBy = $table.".".$columnName;
        }


        if ($searchValue != '') {
            ## Total number of records without filtering
            $query1 = "SELECT COUNT(*) AS allcount FROM $table $paramsSelectLeft WHERE $paramsSelectWhere";
            ## Total number of records with filtering
            $query2 = "SELECT COUNT(*) AS allcount FROM $table $paramsSelectLeft WHERE $searchQuery AND $paramsSelectWhere";
            ## Fetch records
            $query3 = $this->db->prepare("SELECT $paramsSelect FROM $table $paramsSelectLeft WHERE $searchQuery AND $paramsSelectWhere ORDER BY " . $orderBy . " " . $columnSortOrder . " LIMIT :limit,:offset");

        } else {
            ## Total number of records without filtering
            $query1 = "SELECT COUNT(*) AS allcount FROM $table $paramsSelectLeft WHERE $paramsSelectWhere";
            ## Total number of records with filtering
            $query2 = "SELECT COUNT(*) AS allcount FROM $table $paramsSelectLeft WHERE $paramsSelectWhere";
            ## Fetch records
            $query3 = $this->db->prepare("SELECT $paramsSelect FROM $table $paramsSelectLeft WHERE $paramsSelectWhere ORDER BY " . $orderBy . " " . $columnSortOrder . " LIMIT :limit,:offset");
        }

        //var_dump($query1);
        //var_dump($query2);
        // var_dump($query3);
        //var_dump($searchArray);

        ## Total number of records without filtering
        $stmt1 = $this->db->prepare($query1);
        $stmt1->execute();
        $records1 = $stmt1->fetch();
        $totalRecords = $records1['allcount'];
        ## Total number of records with filtering
        $stmt2 = $this->db->prepare($query2);
        foreach ($searchArray as $key => $search) {
            $stmt2->bindParam(':' . $key, $search, PDO::PARAM_STR);
        }
        $stmt2->execute();
        $records2 = $stmt2->fetch();
        $totalRecordwithFilter = $records2['allcount'];
        // Bind values
        foreach ($searchArray as $key => $search) {
            $query3->bindParam(':' . $key, $search, PDO::PARAM_STR);
        }
        $query3->bindParam(':limit', $row, PDO::PARAM_INT);
        $query3->bindParam(':offset', $rowperpage, PDO::PARAM_INT);
        $query3->execute();
        $empRecords = $query3->fetchAll();


        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "data" => $empRecords
        );

        return ($response);
    }

    public function datatablesFetchAllDinamicTablesFilt($table=null, $filtro=null, $params = null, $paramsLeft = null, $whereC = null)
    {
        /*-----------------------------------------------------------
        OBTENGO LOS NOMBRES DE LAS COLUMNAS DE LA DB
        -----------------------------------------------------------*/
        $query = $this->db()->prepare("DESCRIBE $table");
        $query->execute();
        /*-----------------------------------------------------------
        DEVOLVEMOS SOLO EL NOMBRE DE LAS COLUMNAS
        -----------------------------------------------------------*/
        $table_fields = $query->fetchAll(PDO::FETCH_COLUMN);

        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = trim($_POST['search']['value']); // Search value

        $searchArray = array();
        ## Search
        $searchQuery = "";
        if ($searchValue != '') {
            $con = 1;
            //Leo cuantos elementos hay en el array
            $cont = count($table_fields);
            //Consulto las keys del array
            $keys = array_keys($table_fields);
            //Busco la ultima
            if (is_null($filtro)){
                $ultima_key = $keys[$cont - 1];
                $recorrerParams = $table_fields;
            }else{
                $ultima_key = count($filtro) - 1;
                $recorrerParams = $filtro;
            }
            $myfilter = array();
            $searchQuery = '(';
            foreach ($recorrerParams as $key => $value) {
                $va = "param_" . $con;
                if ($key == $ultima_key) {
                    $searchQuery .= '' .  $value . ' LIKE :' . $va . '';
                } else {
                    $searchQuery .= '' .  $value . ' LIKE :' . $va . ' OR ';
                }
                $clea = trim($searchValue);
                $searchArray["$va"] = "%$clea%";
                $con++;
            }
            $searchQuery .= ')';
        }


        if ($params == null) {
            $paramsSelect = "*";
        } else {
            $paramsSelect = $params;
        }

        if ($paramsLeft == null) {
            $paramsSelectLeft = "";
        } else {
            $paramsSelectLeft = $paramsLeft;
        }

        if ($whereC == null) {
            $paramsSelectWhere = "1";
        } else {
            $paramsSelectWhere = $whereC;
        }


        if ($searchValue != '') {
            ## Total number of records without filtering
            $query1 = "SELECT COUNT(*) AS allcount FROM $table $paramsSelectLeft WHERE $paramsSelectWhere";
            ## Total number of records with filtering
            $query2 = "SELECT COUNT(*) AS allcount FROM $table $paramsSelectLeft WHERE $searchQuery AND $paramsSelectWhere";
            ## Fetch records
            $query3 = $this->db->prepare("SELECT $paramsSelect FROM $table $paramsSelectLeft WHERE $searchQuery AND $paramsSelectWhere ORDER BY " . $table.".".$columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

        } else {
            ## Total number of records without filtering
            $query1 = "SELECT COUNT(*) AS allcount FROM $table $paramsSelectLeft WHERE $paramsSelectWhere";
            ## Total number of records with filtering
            $query2 = "SELECT COUNT(*) AS allcount FROM $table $paramsSelectLeft WHERE $paramsSelectWhere";
            ## Fetch records
            $query3 = $this->db->prepare("SELECT $paramsSelect FROM $table $paramsSelectLeft WHERE $paramsSelectWhere ORDER BY " . $table.".".$columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");
        }

        // var_dump($query1);
        // var_dump($query2);
        // var_dump($query3);
        // var_dump($searchArray);

        ## Total number of records without filtering
        $stmt1 = $this->db->prepare($query1);
        $stmt1->execute();
        $records1 = $stmt1->fetch();
        $totalRecords = $records1['allcount'];
        ## Total number of records with filtering
        $stmt2 = $this->db->prepare($query2);
        foreach ($searchArray as $key => $search) {
            $stmt2->bindParam(':' . $key, $search, PDO::PARAM_STR);
        }
        $stmt2->execute();
        $records2 = $stmt2->fetch();
        $totalRecordwithFilter = $records2['allcount'];
        // Bind values
        foreach ($searchArray as $key => $search) {
            $query3->bindParam(':' . $key, $search, PDO::PARAM_STR);
        }
        $query3->bindParam(':limit', $row, PDO::PARAM_INT);
        $query3->bindParam(':offset', $rowperpage, PDO::PARAM_INT);
        $query3->execute();
        $empRecords = $query3->fetchAll();


        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "data" => $empRecords
        );

        return ($response);
    }

    /*=============================================
    MOSTRAR INFO DINAMICA REPORTES WITH WHERE
    =============================================*/
    public function MdlMostrarInfoDinamicWhere($table = null, $params = null, $paramsLeft = null, $whereC = null, $type = null, $pdo_asspc = null, $time_load = null)
    {
        if(!is_null($time_load) && $time_load){
            $requestsql = '';
            $msc = microtime(true);
        }

        if($table == null){
            $table = $this->table;
        }
        if ($params == null) {
            $paramsSelect = "*";
        } else if ($params == 100) {
            $paramsSelect = 100;
        } else {
            $paramsSelect = $params;
        }

        if ($paramsLeft == null) {
            $paramsSelectLeft = "";
        } else {
            $paramsSelectLeft = $paramsLeft;
        }

        if ($whereC == null) {
            $paramsSelectWhere = "";
        } else {
            $paramsSelectWhere = $whereC;
        }
        if ($paramsSelect != 100) {
            $query = "SELECT $paramsSelect FROM $table $paramsSelectLeft WHERE $paramsSelectWhere";
            $stmt = $this->db()->prepare($query);
        } else {
            $stmt = $this->db()->prepare($paramsLeft);
        }
        // d($query);
        // var_dump($query);

        $stmt->execute();

        if ($type == null) {
            if ($pdo_asspc == null) {
                return $stmt->fetch();
            } else {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
        } else if ($type != 100) {
            if ($pdo_asspc == null) {
                return $stmt->fetchAll();
            } else {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }

        } else {
            return "ok";
        }
        $stmt->close();
        $stmt = null;

        if(!is_null($time_load) && $time_load){
            $msc = microtime(true)-$msc;
            $_SESSION["timeLoadRequest"] = array (
                "date" => date('Y-m-d hh:ii:ss'),
                "time_seconds" => $msc.' s',
                "time_miliseconds" => ($msc * 1000).' ms',
            );
        }
    }

    /*-----------------------------------------------------------
    CREAMOS UN METODO GENERAL PARA ACTUALIZAR DATOS
    -----------------------------------------------------------*/
    public function logsDatabase($data)
    {
        $db = $this->db();
        $table = "log_database_at";
        $columns = "(";
        $params = "(";
        foreach ($data as $key => $value) {
            $columns .= $key . ",";
            $params .= ":" . $key . ",";
        }
        $columns = substr($columns, 0, -1);
        $params = substr($params, 0, -1);
        $columns .= ")";
        $params .= ")";
        $query = $db->prepare("INSERT INTO $table $columns VALUES $params");
        foreach ($data as $key => $value) {
            $query->bindParam(":" . $key, $data[$key], PDO::PARAM_STR);
        }
        if ($query->execute()) {
            $_SESSION["las_id_log"] = $db->lastInsertId();
            return "ok";
        } else {
            return "error";
        }
    }
}