<?php
class Active_record
{
	private $conn;
	private $column;
	private $table;
	private $where=[];
	private $or_where=[];
	private $limit='';
	private $group_by='';
	private $order_by='';
	function __construct($host,$user,$password,$dbname)
	{
		$this->conn=new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
	}
	public function select($column)
	{
		$this->column=$column;
	}
	public function from($table)
	{
		$this->table=$table;
	}
	public function where($column,$operator,$value)
	{
		array_push($this->where,$column.$operator."'".$value."'");
	}
	public function or_where($column,$operator,$value)
	{
		array_push($this->or_where,$column.$operator."'".$value."'");
	}
	public function limit($limit,$offset)
	{
		$this->limit='limit '.$offset.', '.$limit;
	}
	public function group_by($column)
	{
		$this->group_by='group by '.$group_by;
	}
	public function order_by($order_by,$type)
	{
		$this->order_by='order by '.$order_by.' '.$type;
	}
	public function result()
	{
		if(count($this->where)<1){
			array_push($this->where,1);
		}
		$where=implode(' and ',$this->where);
		if(count($this->or_where)>0){
			$where=$where.' or '.implode(' or ',$this->or_where);
		}

		$stmt=$this->conn->prepare("select $this->column from $this->table where ".$where." ".$this->group_by." ".$this->limit." ".$this->order_by);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		return $stmt->fetchAll();
	}
	public function row()
	{
		if(count($this->where)<1){
			array_push($this->where,1);
		}
		$where=implode(' and ',$this->where);
		if(count($this->or_where)>0){
			$where=$where.' or '.implode(' or ',$this->or_where);
		}

		$stmt=$this->conn->prepare("select $this->column from $this->table where ".$where." ".$this->group_by." ".$this->limit." ".$this->order_by);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		return $stmt->fetch();
	}
	public function delete($table,$where=NULL)
	{
		if(isset($where)){
			$stmt=$this->conn->prepare("delete from $table where $where");
		}else{
			$stmt=$this->conn->prepare("delete from $table");
		}
		$stmt->execute();
		return $stmt->rowCount();
	}
	public function insert($table,$data)
	{
		$c=[];
		$v=[];
		foreach ($data as $key => $value) {
			array_push($c,$key);
			array_push($v,"'".$value."'");
		}
		$stmt=$this->conn->prepare("INSERT INTO $table (".implode(',',$c).") VALUES (".implode(',',$v).")");
		$stmt->execute();
		return $stmt->rowCount();
	}
	public function update($table,$data,$where=NULL)
	{
		$c=[];
		foreach ($data as $key => $value) {
			array_push($c,$key."='".$value."'");
		}
		$stmt=$this->conn->prepare("UPDATE $table SET ".implode(',',$c)." WHERE $where");
		$stmt->execute();
		return $stmt->rowCount();
	}
	
}