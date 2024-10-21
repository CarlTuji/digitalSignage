<?php
  class DataTablesAjax{
    // Properties
    private $pdo;
    private $table;
    public $draw;
    public $start;
    public $length;
    public $search;
    public $order;
    public $columns;
    public $recordsTotal;
    public $recordsFiltered;
    public $data = array();
    public $sql;
    public $columnsNames;
    
    // methods
    function __construct( $pdo, $table, $data ){
      $this->pdo = $pdo;
      $this->table = $table;
      $this->draw = (int)$data['draw'];
      $this->start = $data['start'];
      $this->length = $data['length'];
      $this->search = $data['search'];
      $this->order = $data['order'];
      $this->columns = $data['columns'];
    }

    function increaseDraw(){
      $this->draw+=1;
    }

    function get_recordsTotal(){
      // return the total of records
      $pdo = $this->pdo;
      $sql = "SELECT * FROM `{$this->table}` WHERE 1";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $this->recordsTotal = $stmt->rowCount();
    }

    function get_recordsFiltered(){
      $pdo = $this->pdo;
      $sql = $this->build_query();
      $stmt = $pdo->prepare( $sql );
      $stmt->execute();
      $this->recordsFiltered = $stmt->rowCount();
    }

    private function build_query(){
      $sql = "SELECT * FROM `{$this->table}`";
      if( $where = $this->build_where_clause() ){
        $sql.=$where;
      }
      if( $order = $this->build_order_clause() ){
        $sql.=$order;
      }
      if( $limit = $this->build_limit_clause() ){
        $sql.=$limit;
      }
      $this->sql = $sql;
      return $sql;
    }

    private function build_where_clause(){
      if( empty($this->search['value']) ){
        $where = " WHERE 1";
      } else {
        // loop trought searchable columns
        $searchableColumnsCount=0;
        foreach( $this->columns as $column ){
          if( $column['searchable'] ){
            $searchableColumnsCount++;
            $whereArray[] = "`{$column['name']}` LIKE'%{$this->search['value']}%'";
          }
        }
        if( $searchableColumnsCount > 0 ){
          $where = " WHERE " . implode(' OR ', $whereArray);
        }
      }
      return $where;
    }

    private function build_order_clause(){
      if( $this->order ){
        foreach( $this->order as $order ){
          $orderParams[] = "{$this->columns[$order['column']]['name']} {$order['dir']}";
        }
        $orderBy = " ORDER BY " . implode( ', ', $orderParams );
        return $orderBy;
      }
      return false;
    }

    private function build_limit_clause(){
      // make LIMIT clause
      if( $this->length >= 0 ){
        return " LIMIT {$this->start}, {$this->length}";
      }
      return false;
    }

    private function get_tableColumnsName(){
      $pdo = $this->pdo;
      $sql="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='digitalDisplay' AND `TABLE_NAME`='{$this->table}'";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      if( $stmt->rowCount() ){
        $columns = $stmt->fetchAll();
        return $columns;
      }
      return false;
    }

    public function get_data(){
      $pdo = $this->pdo;
      // get table columns names
      $db_columns = $this->get_tableColumnsName();

      $sql = $this->build_query();
      $this->sql = $sql;

      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $this->recordsFiltered = $stmt->rowCount();
      if( $stmt->rowCount() ){
        $idx=0;
        $rows=$stmt->fetchAll( PDO::FETCH_ASSOC );
        foreach( $rows as $idx=>$row ){
          $this->data[$idx]['DT_RowId']="Row_" . $row['id'];
          $this->data[$idx]['DT_RowClass']="";
          $this->data[$idx]['DT_RowData']=$row['id'];
          $this->data[$idx]['DT_RowAttr']="";
          foreach( $this->columns as $col ){
            $this->data[$idx][ $col['name'] ] = $row[  $col['name'] ];
          }
        }
      }
      $this->increaseDraw();
      $this->get_recordsTotal();
      //$this->get_recordsFiltered();

      $result = array(
        'draw'=>$this->draw,
        'recordsTotal'=>$this->recordsTotal,
        'recordsFiltered'=>$this->recordsFiltered,
        'sql'=>$this->sql,
        'data'=>$this->data,
        'columns'=>$db_columns
      );
      return $result;
    }

    public function set_unit( $unit_id, $unit_text ){
      $pdo = $this->pdo;
      if( !empty($newUnit) ){
        $sql = "INSERT INTO `units` (`unit_id`,`unit_text`) VALUES (:unit_id, :unit_text)";
        $stmt=$pdo->prepare( $sql );
        $stmt->bindParam(':unit_id', $unit_id, PDO::PARAM_STR);
        $stmt->bindParam(':unit_text', $unit_text, PDO::PARAM_STR);

      }
    }
  }
?>