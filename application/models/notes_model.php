<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notes_Model extends CI_Model {
  public function add($note)
  {
   	$query = 'INSERT INTO notes (title, created_at, updated_at) 
   			  VALUES (?,NOW(), NOW())';
   	$this->db->query($query,array($note['noteTitle']));
    $id=$this->db->insert_id();
   	return $this->get_note($id);
  }

  public function get_note($id)
  {
    return $this->db->where('id',$id)->get('notes')->row_array();
  }

  public function getNotes()
  {
  	return $this->db->query('SELECT * FROM notes')->result_array();
  }

  public function delete($id)
  {
  	$query = "DELETE FROM notes WHERE id = ?";
  	$result = $this->db->query($query,array($id));
  	return $result;
  }

  public function append_desc($id)
  {
    $query = "UPDATE notes SET description = ? WHERE id = ?";
    $result = $this->db->query($query, array($id['noteAppend'],$id['id']));
    return $result;
  }

  public function append_title($id)
  {
    $query = "UPDATE notes SET title = ? WHERE id = ?";
    $result = $this->db->query($query, array($id['titleAppend'],$id['id']));
    return $result;
  }
}