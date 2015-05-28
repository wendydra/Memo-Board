<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notes_Controller extends CI_Controller {

	public function index()
	{
		$notes = $this->notes_model->getNotes();
		$this->load->view('notes_view',array('notes'=>$notes));
	}	

	public function create()
	{
		$result = $this->notes_model->add($this->input->post());

		if ($result)
		{
			echo json_encode(array(
				"success"=>"success",
				"row"=>$result));
		}
		else
		{
			echo "Status failed.";
		}
	}

	public function delete()
	{
		$result = $this->notes_model->delete($this->input->post('id'));
		echo json_encode(array(
			"success"=>"success",
			"row"=>$result));
	}

	public function append()
	{
		$result = $this->notes_model->append_desc($this->input->post());
		echo json_encode(array(
				"success"=>"success",
				"row"=>$result));
	}

	public function edit_title()
	{
		$this->notes_model->append_title($this->input->post());
		echo json_encode(array(
				"success"=>"success",
				"row"=>$result));
	}
}
